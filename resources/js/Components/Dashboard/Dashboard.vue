<template>
  <div>
    <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <dt class="text-sm font-medium text-gray-500 truncate">
            Total Suppliers
          </dt>
          <dd class="mt-1 text-3xl font-semibold text-gray-900">
            {{ stats.suppliers }}
          </dd>
        </div>
      </div>

      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <dt class="text-sm font-medium text-gray-500 truncate">
            Total Distributors
          </dt>
          <dd class="mt-1 text-3xl font-semibold text-gray-900">
            {{ stats.distributors }}
          </dd>
        </div>
      </div>

      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <dt class="text-sm font-medium text-gray-500 truncate">
            Active Purchase Orders
          </dt>
          <dd class="mt-1 text-3xl font-semibold text-gray-900">
            {{ stats.activePurchaseOrders }}
          </dd>
        </div>
      </div>
    </div>

    <!-- Recent Purchase Orders -->
    <div class="bg-white shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Purchase Orders</h3>
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
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="po in recentPurchaseOrders" :key="po.id">
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

export default {
  name: 'Dashboard',
  setup() {
    const stats = ref({
      suppliers: 0,
      distributors: 0,
      activePurchaseOrders: 0,
    })
    const recentPurchaseOrders = ref([])

    const loadDashboardData = async () => {
      try {
        // In a real implementation, these would be separate API endpoints
        const [suppliers, distributors, purchaseOrders] = await Promise.all([
          axios.get('/api/suppliers'),
          axios.get('/api/distributors'),
          axios.get('/api/purchase-orders'),
        ])

        stats.value = {
          suppliers: suppliers.data.data.length,
          distributors: distributors.data.data.length,
          activePurchaseOrders: purchaseOrders.data.data.filter(po =>
            !['delivered', 'cancelled', 'rejected_by_supplier', 'rejected_by_distributor'].includes(po.status)
          ).length,
        }

        recentPurchaseOrders.value = purchaseOrders.data.data
          .slice(0, 5)
          .map(po => ({
            ...po,
            total_value: po.items?.reduce((sum, item) => sum + item.total_price, 0) || 0,
          }))
      } catch (error) {
        console.error('Error loading dashboard data:', error)
      }
    }

    onMounted(() => {
      loadDashboardData()
    })

    return {
      stats,
      recentPurchaseOrders,
    }
  },
}
</script>