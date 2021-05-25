<template>
    <div class="w-full p-4">
        <h2 class="text-2xl font-bold mb-4">Eliminar Inversión</h2>

        <form @submit.prevent="submit">
            
            <p class="my-4">¿Está seguro que desea eliminar la inversión Nro: {{investment.id}}? </p>

            <div class="flex justify-end mt-4">
                <jet-button
                    @click="close"
                    type="button"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Cancelar
                </jet-button>
                <jet-button
                    type="submit"
                    class="ml-4 bg-red-600 hover:bg-red-500"
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
export default {
    props: {
        investment: Object,
    },
    components: {
        JetButton,
    },
    data() {
        return {
            form: this.$inertia.form(),
        };
    },
    methods: {
        submit() {
            this.form.delete(this.route("investment.destroy",{investment : this.investment}), {
                onFinish: () => {
                    this.form.reset();
                    this.$emit("onFinish");
                },
            });
        },

        close() {
            this.$emit("onClose");
        },
    },
};
</script>

<style></style>
