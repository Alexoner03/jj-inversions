<template>
    <div ref="wrapper"></div>
</template>

<script>
import { Grid, h, html } from "gridjs";
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
        leads: {
            type: Array,
            required: true,
        },
    },

    mounted() {
        this.grid = new Grid({
            columns: [
                {
                    id: "id",
                    name: "Id",
                    hidden: true,
                    data: (row) => row.id,
                },
                {
                    id: "name",
                    name: "Nombres",
                    data: (row) => row.name,
                    minWidth : 250,
                },
                {
                    id: "email",
                    name: "Correo Eléctronico",
                    data: (row) => row.mail,
                },
                {
                    id: "created_at",
                    name: "Fecha",
                    data: (row) => row.created_at,
                },
                {
                    id: "phone",
                    name: "Telefono",
                    data: (row) => row.phone,
                },
                {
                    name: "Acciones",
                    formatter: (cell, row, col) => {
                        return [
                            h(
                                "button",
                                {
                                    onClick: () =>
                                        this.sendShow(row.cell(0).data),
                                    className:
                                        "md:mr-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition",
                                },
                                "Ver Mensaje"
                            ),
                            h(
                                "button",
                                {
                                    onClick: () =>
                                        this.sendDelete(row.cell(0).data),
                                    className:
                                        "inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition",
                                },
                                "Eliminar"
                            ),
                        ];
                    },
                },
            ],
            data: this.leads,
            pagination: {
                enabled: true,
                limit: 5,
                summary: false,
            },
            search: {
                enabled: true,
            },
            sort:true,
            language: esES,
        }).render(this.$refs.wrapper);
    },

    methods: {
        sendDelete(lead) {
            this.$emit("onDelete", lead);
        },

        sendShow(lead){
            this.$emit("onShow", lead);
        }

    },
};
</script>