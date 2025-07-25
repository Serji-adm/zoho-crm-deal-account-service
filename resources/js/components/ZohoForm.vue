<script>
import axios from 'axios'

export default {
    data() {
        return {
            deal: {deal_name: '', stage: ''},
            account: {account_name: '', website: '', phone: ''},
        }
    },
    methods: {
        async submitForm() {
            try {
                await axios.post('/api/zoho/deal-account', {
                    deal: this.deal,
                    account: this.account
                })
                alert('Successfully submitted to Zoho!')
            } catch (e) {
                alert('Error: ' + e.response?.data?.message || e.message)
            }
        }
    }
}
</script>

<template>
    <form @submit.prevent="submitForm" class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold text-center mb-1">Deal</h2>
        <div class="mb-4">
            <label class="block font-semibold mb-1" for="deal-name">Deal Name:</label>
            <input v-model="deal.deal_name" id="deal-name" type="text"
                   class="w-full border border-gray-300 p-2 rounded" required/>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1" for="stage">Stage:</label>
            <input v-model="deal.stage" id="stage" type="text"
                   class="w-full border border-gray-300 p-2 rounded" required/>
        </div>

        <h2 class="text-2xl font-semibold text-center mb-1">Account</h2>
        <div class="mb-4">
            <label class="block font-semibold mb-1" for="account-name">Account Name:</label>
            <input v-model="account.account_name" id="account-name" type="text"
                   class="w-full border border-gray-300 p-2 rounded" required/>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1" for="website">Website:</label>
            <input v-model="account.website" id="website" type="text"
                   class="w-full border border-gray-300 p-2 rounded" />
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1" for="phone">Phone:</label>
            <input v-model="account.phone" id="phone" type="text"
                   class="w-full border border-gray-300 p-2 rounded" />
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Submit to Zoho
        </button>
    </form>
</template>

<style scoped>

</style>
