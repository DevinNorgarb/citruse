<template>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Suppliers</h1>
      <button
        @click="showCreateModal = true"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >
        Add Supplier
      </button>
    </div>

    <!-- Error Alert -->
    <div v-if="error" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ error }}</span>
    </div>

    <!-- Success Alert -->
    <div v-if="success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ success }}</span>
    </div>

    <!-- Loading State -->
    <div v-if="loading" class="flex justify-center items-center py-8">
      <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
    </div>

    <!-- Supplier List -->
    <div v-else class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Business Name
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Country
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              VAT Number
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="supplier in suppliers" :key="supplier.id">
            <td class="px-6 py-4 whitespace-nowrap">
              {{ supplier.business_name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              {{ supplier.country }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              {{ supplier.vat_number }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
              <button
                @click="editSupplier(supplier)"
                class="text-indigo-600 hover:text-indigo-900 mr-4"
              >
                Edit
              </button>
              <button
                @click="deleteSupplier(supplier)"
                class="text-red-600 hover:text-red-900"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Create/Edit Modal -->
    <div v-if="showCreateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
          <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">
            {{ editingSupplier ? 'Edit Supplier' : 'Add Supplier' }}
          </h3>
          <form @submit.prevent="saveSupplier">
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="business_name">
                Business Name
              </label>
              <input
                v-model="form.business_name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="business_name"
                type="text"
                required
              >
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="country">
                Country
              </label>
              <input
                v-model="form.country"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="country"
                type="text"
                required
              >
            </div>
            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="vat_number">
                VAT Number
              </label>
              <input
                v-model="form.vat_number"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="vat_number"
                type="text"
                required
              >
            </div>
            <div class="flex justify-end">
              <button
                type="button"
                @click="showCreateModal = false"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
              >
                Cancel
              </button>
              <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                :disabled="saving"
              >
                {{ saving ? 'Saving...' : 'Save' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'

export default {
  name: 'SupplierList',
  setup() {
    const suppliers = ref([])
    const showCreateModal = ref(false)
    const editingSupplier = ref(null)
    const loading = ref(false)
    const saving = ref(false)
    const error = ref(null)
    const success = ref(null)
    const form = ref({
      business_name: '',
      country: '',
      vat_number: '',
    })

    const loadSuppliers = async () => {
      loading.value = true
      error.value = null
      try {
        const response = await axios.get('/api/suppliers')
        suppliers.value = response.data.data
      } catch (error) {
        console.error('Error loading suppliers:', error)
        error.value = 'Failed to load suppliers. Please try again.'
      } finally {
        loading.value = false
      }
    }

    const saveSupplier = async () => {
      saving.value = true
      error.value = null
      success.value = null
      try {
        if (editingSupplier.value) {
          await axios.put(`/api/suppliers/${editingSupplier.value.id}`, form.value)
          success.value = 'Supplier updated successfully!'
        } else {
          await axios.post('/api/suppliers', form.value)
          success.value = 'Supplier created successfully!'
        }
        showCreateModal.value = false
        loadSuppliers()
        resetForm()
      } catch (error) {
        console.error('Error saving supplier:', error)
        error.value = error.response?.data?.message || 'Failed to save supplier. Please try again.'
      } finally {
        saving.value = false
      }
    }

    const editSupplier = (supplier) => {
      editingSupplier.value = supplier
      form.value = { ...supplier }
      showCreateModal.value = true
    }

    const deleteSupplier = async (supplier) => {
      if (confirm('Are you sure you want to delete this supplier?')) {
        error.value = null
        success.value = null
        try {
          await axios.delete(`/api/suppliers/${supplier.id}`)
          success.value = 'Supplier deleted successfully!'
          loadSuppliers()
        } catch (error) {
          console.error('Error deleting supplier:', error)
          error.value = 'Failed to delete supplier. Please try again.'
        }
      }
    }

    const resetForm = () => {
      form.value = {
        business_name: '',
        country: '',
        vat_number: '',
      }
      editingSupplier.value = null
    }

    onMounted(() => {
      loadSuppliers()
    })

    return {
      suppliers,
      showCreateModal,
      editingSupplier,
      form,
      loading,
      saving,
      error,
      success,
      saveSupplier,
      editSupplier,
      deleteSupplier,
    }
  },
}
</script>