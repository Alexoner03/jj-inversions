<template>
    <app-layout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight capitalize"
            >
                Inversionista Detalle
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <investor-profile
                    :investor="investor"
                    :investmentsLength="investments.length"
                />

                <br />

                <hr />

                <br />

                <h2 class="text-3xl">Inversiones</h2>

                <div class="flex justify-between my-4">
                    <jet-button type="button" @click="showModalCreate = !showModalCreate">Nueva Inversión</jet-button>
                </div>

                <investments-table :investments="investments" @onEdit="editInvestment" @onDelete="deleteInvestment" :key="reloadTable"/>
            </div>
        </div>

        <jet-modal :show="showModalCreate">
            <investment-create :investor="investor" @onFinish="close('create')" @onClose="close('create')"/>
        </jet-modal>

        <jet-modal :show="showModalEdit">
            <investment-edit :investment="investmentSelected" @onFinish="close('edit')" @onClose="close('edit')"/>
        </jet-modal>

        <jet-modal :show="showModalDelete">
            <investment-delete :investment="investmentSelected" @onFinish="close('delete')" @onClose="close('delete')"/>
        </jet-modal>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import InvestorProfile from "./components/InvestorProfile.vue";
import InvestmentsTable from "./components/InvestmentsTable.vue";
import InvestmentCreate from "./components/InvestmentCreate.vue";
import InvestmentEdit from "./components/InvestmentEdit.vue";
import InvestmentDelete from "./components/InvestmentDelete.vue";
import JetModal from '@/Jetstream/Modal'
import JetButton from '@/Jetstream/Button'

export default {
    props: {
        investor: Object,
        investments: Array,
    },

    components: {
        AppLayout,
        InvestorProfile,
        InvestmentsTable,
        InvestmentCreate,
        InvestmentEdit,
        InvestmentDelete,
        JetButton,
        JetModal
    },

    data() {
        return {
            showModalCreate : false,
            showModalEdit : false,
            showModalDelete : false,
            investmentSelected : null,
            reloadTable : 0,
        };
    },

    methods : {
        editInvestment(idInvestment){
            this.investmentSelected = this.investments.find(investment => investment.id === idInvestment);
            this.showModalEdit = true;
        },
        deleteInvestment(idInvestment){
            this.investmentSelected = this.investments.find(investment => investment.id === idInvestment);
            this.showModalDelete = true;
        },
        close(operation){
            switch (operation) {
                case 'create':
                    this.showModalCreate = false;
                    break;
                case 'edit':
                    this.showModalEdit = false;
                    break;
                case 'delete':
                    this.showModalDelete = false;
                    break;
            }

            this.reloadTable++;
        }
    },
};
</script>
