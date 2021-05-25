<template>
    <div class="w-full p-4">
        <h2 class="text-2xl font-bold mb-4">Registrar nueva Inversión</h2>

        <jet-validation-errors class="mb-4" />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="mount" value="Monto" />
                <input
                    type="number"
                    name="mount"
                    id="mount"
                    step="0.01"
                    v-model="form.mount"
                    required
                    autocomplete="mount"
                    autofocus
                    class="
                        border-gray-300
                        focus:border-indigo-300
                        focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                        rounded-md
                        shadow-sm
                        mt-1
                        block
                        w-full
                    "
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
                    class="
                        border-gray-300
                        focus:border-indigo-300
                        focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                        rounded-md
                        shadow-sm
                        mt-1
                        block
                        w-full
                    "
                />
            </div>
            <div class="mt-4">
                <jet-label value="Tiempo en inversión" />
                <div class="mt-1 w-full flex justify-start items-center">
                        <input
                        type="number"
                        name="time_cant"
                        id="time_cant"
                        v-model="form.time_cant"
                        required
                        autocomplete="time_cant"
                        class="
                            mr-4
                            border-gray-300
                            focus:border-indigo-300
                            focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                            rounded-md
                            shadow-sm
                            block
                        "
                    />
                    <multiselect style="margin : 0 !important" v-model="form.time_type" v-bind="selectOptions" @change="changeSelect"/>
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
import Multiselect from "@vueform/multiselect";

export default {
    props: {
        investor: Object,
    },
    components: {
        JetButton,
        JetInput,
        JetLabel,
        JetValidationErrors,
        Multiselect,
    },
    data() {
        return {
            selectOptions: {
                mode: "single",
                options: [
                    { value: "months", label: "Meses" },
                    { value: "years", label: "Años" },
                ],
                searchable: true,
                createTag: true,
                clear : false,
                noResultsText: "No hay mas resultados",
                required : true
            },
            form: this.$inertia.form({
                mount: 0,
                percentage: 0,
                investor_id: this.investor.id,
                time_cant: 1,
                time_type: "months",
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(this.route("investment.store"), {
                onSuccess: () => {
                    this.form.reset();
                    this.$emit("onFinish");
                },
            });
        },

        changeSelect(value){
            setTimeout(() => {
                if(!value){
                this.form.time_type =  "months"
            }
            }, 100);
        },

        close() {
            this.$emit("onClose");
        },
    },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
