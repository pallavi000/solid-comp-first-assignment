<script setup lang="ts">
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
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


const handleConfirmRemoveIP = () => {
    showConfirmModal.value = true;
};


const removeCurrentIpToAllowedIps = () => {
    form.post(route('restricted.ip.remove'), {
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
            <h2 class="text-lg font-medium text-gray-900">Remove IP from allowed list?</h2>


            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 mt-4" role="alert">
                <span class="font-medium mr-2">Note:</span> This is for testing purposes only! You will <b>NOT</b> be
                able to
                access restricted page once you remove your ip from
                the allowed list.
            </div>


        </header>

        <DangerButton @click="handleConfirmRemoveIP">Remove Your IP from allowed ips</DangerButton>

        <Modal :show="showConfirmModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to remove your ip from allowed list?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your ip is removed from allowed list, you'll <b>NOT</b> be able to view restricted
                    routes/pages.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
                    <DangerButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="removeCurrentIpToAllowedIps">
                        Remove from Allow IPs
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
