<template>
    <Modal :show="modelValue" max-width="sm" @show="onShow">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Create New Folder
            </h2>
            <div class="mt-6">
                <InputLabel for="folderName" value="Folder Name" />
                <TextInput type="text" ref="folderNameInput" id="folderName" v-model="form.name"
                    class="mt-1 block w-full"
                    :class="form.errors.name ? 'border-red-500 focus:border-red-500 focus:ring-red-500':''"
                    placeholder="Folder Name" @keyup.enter="createFolder" />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>
            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                <PrimaryButton class="ml-3" :class="{ 'opacity-25' : form.processing }" @click="createFolder"
                    :disable="form.processing">
                    Submit
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>

<script setup>
// Imports
import { useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { nextTick, ref } from "vue";

// Uses
const form = useForm({
    name: ''
})

// Refs
const folderNameInput = ref(null)

// Props & Emits
const {modelValue} = defineProps({
    modelValue: Boolean
})

const emit = defineEmits(['update:modelValue'])

// Computed

// Methods
function onShow() {
    nextTick(() => folderNameInput.value.focus())
}

function createFolder() {
    form.post(route('folder.create'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
        },
        onError: () => folderNameInput.value.focus()
    })
}

function closeModal() {
    emit('update:modelValue')
    form.clearErrors()
    form.reset()
}
// Hooks

</script>