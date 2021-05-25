<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Inversionista
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
                                <jet-label for="last_name" value="Apellidos" />
                                <jet-input
                                    id="last_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.last_name"
                                    required
                                    autofocus
                                    autocomplete="last_name"
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
                                <jet-label
                                    for="dni"
                                    value="Documento de Identidad"
                                />
                                <jet-input
                                    id="dni"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.dni"
                                    required
                                />
                            </div>

                            <div class="mt-4">
                                <jet-label for="phone" value="Teléfono" />
                                <jet-input
                                    id="phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.phone"
                                    required
                                    autocomplete="phone"
                                />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <jet-button
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Actualizar
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
        investor: Object,
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
            form: this.$inertia.form({
                name: this.$props.investor.name,
                last_name: this.$props.investor.last_name,
                email: this.$props.investor.email,
                dni: this.$props.investor.dni,
                phone: this.$props.investor.phone,
            }),
        };
    },

    methods: {
        submit() {
            this.form.put(
                this.route("investor.update", { investor: this.$props.investor })
            );
        },
    },
};
</script>
