<template>
  <div>
    <h2 class="text-2xl font-bold mb-6">Purchase Orders</h2>
    <div class="bg-white shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  PO Number
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Type
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Total Value
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="po in purchaseOrders" :key="po.id">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ po.po_number }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ po.type }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ po.status }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  R{{ po.total_value }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  <button
                    v-if="canAccept(po)"
                    @click="acceptPurchaseOrder(po)"
                    class="text-blue-600 hover:text-blue-900 mr-2"
                  >
                    Accept
                  </button>
                  <button
                    v-if="canReject(po)"
                    @click="rejectPurchaseOrder(po)"
                    class="text-red-600 hover:text-red-900"
                  >
                    Reject
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useAuthStore } from '@/stores/auth'

export default {
  name: 'PurchaseOrderList',
  setup() {
    const purchaseOrders = ref([])
    const authStore = useAuthStore()

    const loadPurchaseOrders = async () => {
      try {
        const response = await axios.get('/api/purchase-orders')
        purchaseOrders.value = response.data.data.map(po => ({
          ...po,
          total_value: po.items?.reduce((sum, item) => sum + item.total_price, 0) || 0
        }))
      } catch (error) {
        console.error('Error loading purchase orders:', error)
      }
    }

    const canAccept = (po) => {
      if (authStore.isPurchasingManager) {
        return po.status === 'pending'
      }
      if (authStore.isFieldSalesAssociate) {
        return po.status === 'pending_supplier_approval'
      }
      return false
    }

    const canReject = (po) => {
      if (authStore.isPurchasingManager) {
        return po.status === 'pending'
      }
      if (authStore.isFieldSalesAssociate) {
        return po.status === 'pending_supplier_approval'
      }
      return false
    }

    const acceptPurchaseOrder = async (po) => {
      try {
        if (authStore.isPurchasingManager) {
          await axios.post(`/api/purchase-orders/${po.id}/accept-by-distributor`)
        } else if (authStore.isFieldSalesAssociate) {
          await axios.post(`/api/purchase-orders/${po.id}/accept-by-supplier`)
        }
        await loadPurchaseOrders()
      } catch (error) {
        console.error('Error accepting purchase order:', error)
      }
    }

    const rejectPurchaseOrder = async (po) => {
      try {
        if (authStore.isPurchasingManager) {
          await axios.post(`/api/purchase-orders/${po.id}/reject-by-distributor`)
        } else if (authStore.isFieldSalesAssociate) {
          await axios.post(`/api/purchase-orders/${po.id}/reject-by-supplier`)
        }
        await loadPurchaseOrders()
      } catch (error) {
        console.error('Error rejecting purchase order:', error)
      }
    }

    onMounted(() => {
      loadPurchaseOrders()
    })

    return {
      purchaseOrders,
      canAccept,
      canReject,
      acceptPurchaseOrder,
      rejectPurchaseOrder
    }
  }
}
</script>