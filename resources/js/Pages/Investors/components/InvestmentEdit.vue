<template>
    <div class="w-full p-4">
        <h2 class="text-2xl font-bold mb-4">Editar nueva Inversión</h2>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="mount" value="Monto" />
                <input
                    type="number"
                    name="mount"
                    step="0.01"
                    id="mount"
                    v-model="form.mount"
                    required
                    autocomplete="mount"
                    autofocus
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                />
            </div>
            <div class="mt-4">
                <jet-label for="percentage" value="Porcentaje" />
                 <input
                    type="number"
                    name="percentage"
                    step="0.01"
                    id="percentage"
                    v-model="form.percentage"
                    required
                    autocomplete="percentage"
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                />
            </div>

            <div class="mt-4">
                <jet-label for="investment_state_id" value="Estado" />
                <div class="relative inline-block w-full text-gray-700">
                    <select
                        id="investment_state_id"
                        name="investment_state_id"
                        v-model="form.investment_state_id"
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                    >
                        <option value="1" :selected="investment.investment_state_id === 1">En proceso</option>
                        <option value="2" :selected="investment.investment_state_id === 2">Finalizado</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <jet-button
                    @click="close"
                    type="button"
                    class="ml-4 bg-red-600 hover:bg-red-500"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Cancelar
                </jet-button>
                <jet-button
                    type="submit"
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Confirmar
                </jet-button>
            </div>
        </form>
    </div>
</template>

<script>
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
export default {
    props: {
        investment: Object,
    },
    components: {
        JetButton,
        JetInput,
        JetLabel,
        JetValidationErrors,
    },
    data() {
        return {
            form: this.$inertia.form({
                investment_state_id: this.investment.investment_state_id,
                mount: this.investment.mount,
                percentage: this.investment.percentage,
            }),
        };
    },
    methods: {
        submit() {
            this.form.put(
                this.route("investment.update", {
                    investment: this.investment.id,
                }),
                {
                    onSuccess: () => {
                        this.form.reset();
                        this.$emit("onFinish");
                    },
                }
            );
        },

        close() {
            this.$emit("onClose");
        },
    },
};
</script>

<style></style>
