<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Calculadora
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white w-full rounded-lg shadow-xl">
                    <div class="p-4 border-b">
                        <h2 class="text-2xl">Configuración de la Calculadora</h2>
                    </div>
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600 font-bold">
                                Valor Actual
                            </p>
                            <p>
                                {{ calculator.value }} %
                            </p>
                        </div>
                    </div>
                    <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600 font-bold">
                                Formula
                            </p>
                            <p>
                               Monto de inversión + ( ( Monto de inversión * {{ calculator.value }} % ) / 100) = Retribución
                            </p>
                        </div>
                    </div>
                     <div>
                        <div
                            class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                        >
                            <p class="text-gray-600 font-bold">
                                Editar
                            </p>
                            <p>
                               <jet-input type="number" class="mr-4" v-model="form.value"/>
                                <jet-button @click="saveConfig">Guardar</jet-button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetInput from '@/Jetstream/Input'
import JetButton from '@/Jetstream/Button'

export default {
    props: {
        calculator: Object,
    },

    data() {
        return {
            form : this.$inertia.form({
                value : this.calculator.value
            })
        };
    },

    components: {
        AppLayout,
        JetInput,
        JetButton
    },

    methods: {
        saveConfig(){
            this.form.put(this.route("calculator.update", { calculator: this.calculator }))
        }
    },
};
</script>
