<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Leads
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <leads-table
                    :leads="leads"
                    @onDelete="confirmLeadDeletion"
                    @onShow="showMessage"
                    :key="reloadTable"
                />
                <!-- Eliminar Cuenta Confirmation Modal -->
                <jet-dialog-modal
                    :show="confirmingLeadDeletion"
                    @close="closeModal"
                >
                    <template #title> Eliminar Contacto </template>

                    <template #content>
                        ¿Estás seguro de que deseas eliminar este contacto?
                    </template>

                    <template #footer>
                        <jet-secondary-button @click="closeModal">
                            Cancelar
                        </jet-secondary-button>

                        <jet-danger-button
                            class="ml-2"
                            @click="deleteLead"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Eliminar
                        </jet-danger-button>
                    </template>
                </jet-dialog-modal>

                <jet-dialog-modal :show="showMessageModal" @close="closeModal">
                    <template #title> Mensaje </template>
                    <template #content>
                        {{ message }}
                    </template>
                    <template #footer>
                        <jet-secondary-button @click="closeModal">
                            Cerrar
                        </jet-secondary-button>
                    </template>
                </jet-dialog-modal>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import LeadsTable from "./components/LeadsTable";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    props: {
        leads: Array,
    },

    data() {
        return {
            confirmingLeadDeletion: false,
            leadselected: -1,
            reloadTable: 0,
            showMessageModal: false,
            form: this.$inertia.form(),

            message: "",
        };
    },

    components: {
        AppLayout,
        LeadsTable,
        JetDangerButton,
        JetDialogModal,
        JetSecondaryButton,
    },

    methods: {
        confirmLeadDeletion(lead) {
            this.leadselected = lead;
            this.confirmingLeadDeletion = true;
        },

        deleteLead() {
            this.form.delete(
                route("lead.destroy", { lead: this.leadselected }),
                {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onFinish: () => {
                        this.form.reset();
                        this.reloadTable++;
                    },
                }
            );
        },

        showMessage(idLead) {
            let _message = this.leads.find(lead => lead.id === idLead).message
            this.message = _message && _message !== "" ? _message : "No hay un mensaje en este contacto"
            this.showMessageModal = true;
        },

        closeModal() {
            this.showMessageModal = false;
            this.confirmingLeadDeletion = false;
        },
    },
};
</script>
