<script setup lang="ts">
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const { ip } = defineProps<{
    ip: string
}>();

const showConfirmModal = ref(false);

const form = useForm({
    ip,
});


const handleConfirmAddIP = () => {
    showConfirmModal.value = true;
};


const addCurrentIpToAllowedIps = () => {
    form.post(route('restricted.ip.add'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => alert("some error occurred!"),
    });
};

const closeModal = () => {
    showConfirmModal.value = false;
};

</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Add IP to allowed list?</h2>


            <div class="p-4 text-sm text-red-800 rounded-lg bg-red-50 mt-4" role="alert">
                <span class="font-medium mr-2">Note:</span> This is for testing purposes only! You will be able to
                access restricted page once you added your ip to
                the allowed list.
            </div>


        </header>

        <PrimaryButton @click="handleConfirmAddIP">Add Your IP to allowed ips</PrimaryButton>

        <Modal :show="showConfirmModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to add your ip to allowed list?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your ip is added to allowed list, you'll be able to view restricted routes/pages.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
                    <PrimaryButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="addCurrentIpToAllowedIps">
                        Add to Allow IPs
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
