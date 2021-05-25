<template>
    <div ref="wrapper"></div>
</template>

<script>
import { Grid, h } from "gridjs";
import { esES } from "gridjs/dist/gridjs.lang.es";

export default {
    components: {
        Grid,
    },

    data() {
        return {
            grid: null,
        };
    },

    props: {
        investments: {
            type: Array,
            required: true,
        },
    },

    mounted() {
        this.grid = new Grid({
            columns: [
                {
                    id: "id",
                    name: "Nro.",
                    data: (row) => row.id,
                },
                {
                    id: "mount",
                    name: "Monto",
                    data: (row) => row.mount,
                },
                {
                    id: "percentage",
                    name: "Porcentaje",
                    data: (row) => row.percentage,
                },
                {
                    id: "created_at",
                    name: "Registrado",
                    data: (row) => row.created_at,
                },
                {
                    id: "ended_at",
                    name: "Finaliza",
                    data: (row) => row.ended_at,
                },
                {
                    id: "state",
                    name: "Estado",
                    data: (row) => row.state.description,
                },
                {
                    name: "Acciones",
                    attributes: {
                        className: "gridjs-th actions",
                    },
                    formatter: (cell, row) => {
                        return this.checkActionsByRol(row);
                    },
                    sort : false,
                },
            ],
            data: this.investments,
            pagination: {
                enabled: true,
                limit: 5,
                summary: false,
            },
            search: {
                enabled: true,
            },
            language: esES,
            sort: true,
        }).render(this.$refs.wrapper);
    },

    methods: {
        sendDelete(idInvestment) {
            this.$emit("onDelete", idInvestment);
        },

        toEdit(idInvestment) {
            this.$emit("onEdit", idInvestment);
        },

        checkActionsByRol(row) {
            if (this.$page.props.is_admin) {
                return [
                    h(
                        "button",
                        {
                            onClick: () => this.toEdit(row.cell(0).data),
                            className:
                                "mr-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition",
                        },
                        "Editar"
                    ),
                    h(
                        "button",
                        {
                            onClick: () => this.sendDelete(row.cell(0).data),
                            className:
                                "mr-4 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition",
                        },
                        "Eliminar"
                    ),
                ];
            }

            return [
                h(
                    "button",
                    {
                        onClick: () => this.toEdit(row.cell(0).data),
                        className:
                            "mr-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition",
                    },
                    "Editar"
                ),
            ];
        },
    },
};
</script>

<style>
td.actions {
    border: 1px solid #e5e7eb !important;
    padding: 12px 24px !important;
    background-color: #fff !important;
    box-sizing: content-box !important;
    display: flex;
    align-items: center;
}
</style>
