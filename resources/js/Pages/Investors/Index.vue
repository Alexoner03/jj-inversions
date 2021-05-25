<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inversionistas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex mb-8">
                    <inertia-link
                        :href="route('investor.create')"
                        class="inline-flex items-center mr-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                    >
                        Nuevo Inversionista
                    </inertia-link>
                     <inertia-link
                        :href="route('investor.mailing')"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                    >
                        Mailing
                    </inertia-link>
                </div>
                <investors-table :investors="investors" @onDelete="confirmInvestorDeletion" :key="reloadTable"/>

                <!-- Eliminar Cuenta Confirmation Modal -->
                <jet-dialog-modal
                    :show="confirmingInvestorDeletion"
                    @close="closeModal"
                >
                    <template #title> Eliminar Inversionista </template>

                    <template #content>
                        ¿Estás seguro de que deseas eliminar este inversionista?
                    </template>

                    <template #footer>
                        <jet-secondary-button @click="closeModal">
                            Cancelar
                        </jet-secondary-button>

                        <jet-danger-button
                            class="ml-2"
                            @click="deleteInvestor"
                            :class="{ 'opacity-25': loading }"
                            :disabled="loading"
                        >
                            Eliminar Cuenta
                        </jet-danger-button>
                    </template>
                </jet-dialog-modal>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import InvestorsTable from "./components/InvestorsTable";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {

    props: {
        investors: Array,
    },

    data() {
        return {
            confirmingInvestorDeletion: false,
            idInvestor : null,
            loading : false,
            reloadTable : 0,
        };
    },

    components: {
        AppLayout,
        InvestorsTable,
        JetDangerButton,
        JetDialogModal,
        JetSecondaryButton,
    },

    methods: {
        confirmInvestorDeletion(idInvestor) {
            this.idInvestor = idInvestor;
            this.confirmingInvestorDeletion = true;
        },

        deleteInvestor() {
            this.$inertia.delete(route("investor.destroy",{investor : this.idInvestor}), {
                preserveScroll: true,
                onStart : () => this.loading = true,
                onFinish : () => {
                    this.loading = false;
                    this.reloadTable++;
                },
                onSuccess: () => this.closeModal()
            });
        },

        closeModal() {
            this.confirmingInvestorDeletion = false;
            this.reloadTable++;
        },
    },
};
</script>
