<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Usuario
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="w-1/3 mx-auto">
                    <jet-validation-errors class="mb-4" />

                    <div class="container mx-auto">
                        <form @submit.prevent="submit">
                            <div>
                                <jet-label for="name" value="Nombres" />
                                <jet-input
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                            </div>

                            <div class="mt-4">
                                <jet-label
                                    for="email"
                                    value="Correo Eléctronico"
                                />
                                <jet-input
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                />
                            </div>

                            <div class="mt-4">
                                <jet-label for="terms">
                                    <div class="flex items-center">
                                        <jet-checkbox
                                            name="role"
                                            id="role"
                                            v-model:checked="form.is_admin"
                                        />

                                        <div class="ml-2">
                                            Permisos de Administrador
                                        </div>
                                    </div>
                                </jet-label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <jet-button
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Actualizar Usuario
                                </jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    props: {
        user: Object,
    },

    components: {
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        JetActionMessage,
        AppLayout,
    },

    data() {
        return {
            message: false,
            messageContent: "",
            form: this.$inertia.form({
                name: this.$props.user.name,
                email: this.$props.user.email,
                is_admin: this.$props.user.is_admin,
            }),
        };
    },
    methods: {
        submit() {
            this.form.put(
                this.route("user.update", { user: this.$props.user })
            );
        },
    },
};
</script>
