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
        investors: {
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
                    minWidth : 250,
                    data: (row) => row.name,
                },
                {
                    id: "last_name",
                    name: "Apellidos",
                    minWidth : 250,
                    data: (row) => row.last_name,
                },
                {
                    id: "email",
                    name: "Email",
                    data: (row) => row.email,
                },
                {
                    id: "dni",
                    name: "DNI",
                    data: (row) => row.dni,
                },
                {
                    id: "phone",
                    name: "Telefono",
                    data: (row) => row.phone,
                },
                {
                    name: "Acciones",
                    attributes: {
                        className: "gridjs-th actions",
                    },
                    formatter: (cell, row) => {
                        return this.checkActionsByRol(row);
                    },
                    sort : false
                },
            ],
            data: this.investors,
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
        sendDelete(idInvestor) {
            this.$emit("onDelete", idInvestor);
        },

        toEdit(idInvestor) {
            this.$inertia.visit(
                route("investor.edit", { investor: idInvestor })
            );
        },

        toDetail(idInvestor) {
            this.$inertia.visit(
                route("investor.show", { investor: idInvestor })
            );
        },

        redirect(phone) {
            window.open(
                `https://api.whatsapp.com/send?phone=${phone}`,
                "_blank"
            );
        },

        mailto(mail) {
            window.open(`mailto:${mail}`);
        },

        checkActionsByRol(row) {
            if (this.$page.props.is_admin) {
                return [
                    h(
                        "button",
                        {
                            onClick: () => this.toDetail(row.cell(0).data),
                            className:
                                "mr-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition",
                        },
                        "Ver"
                    ),
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
                    h(
                        "button",
                        {
                            onClick: () => this.redirect(row.cell(4).data),
                            className:
                                "mr-4 inline-flex items-center justify-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition",
                        },
                        html(
                            '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>'
                        )
                    ),
                    h(
                        "button",
                        {
                            onClick: () => this.mailto(row.cell(3).data),
                            className:
                                "mr-4 inline-flex items-center justify-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-300 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition",
                        },
                        html(
                            '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M12 .02c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.99 6.98l-6.99 5.666-6.991-5.666h13.981zm.01 10h-14v-8.505l7 5.673 7-5.672v8.504z"/></svg>'
                        )
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
                    "Ver"
                ),
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
                        onClick: () => this.redirect(row.cell(4).data),
                        className:
                            "mr-4 inline-flex items-center justify-center px-4 py-2 bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-300 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 transition",
                    },
                    html(
                        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>'
                    )
                ),
                h(
                    "button",
                    {
                        onClick: () => this.mailto(row.cell(3).data),
                        className:
                            "mr-4 inline-flex items-center justify-center px-4 py-2 bg-indigo-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-300 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition",
                    },
                    html(
                        '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M12 .02c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.99 6.98l-6.99 5.666-6.991-5.666h13.981zm.01 10h-14v-8.505l7 5.673 7-5.672v8.504z"/></svg>'
                    )
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
