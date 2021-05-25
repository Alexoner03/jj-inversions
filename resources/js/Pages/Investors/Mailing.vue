<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mailing
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white w-full rounded-lg shadow-xl p-4">
                    <div class="my-4">
                        <h2 class="text-2xl font-bold mb-4">
                            Enviar un correo eléctronico a todos los
                            inversionistas
                        </h2>

                        <jet-validation-errors class="mb-4" />

                        <form @submit.prevent="submit">
                            <div>
                                <jet-label value="Seleccione clientes" />
                                <multiselect
                                    v-model="form.investors"
                                    v-bind="selectOptions"
                                />
                            </div>

                            <div class="mt-4">
                                <jet-label for="title" value="Titulo" />
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    v-model="form.title"
                                    required
                                    autocomplete="title"
                                    autofocus
                                    class="
                                        border-gray-300
                                        focus:border-indigo-300
                                        focus:ring
                                        focus:ring-indigo-200
                                        focus:ring-opacity-50
                                        rounded-md
                                        shadow-sm
                                        mt-1
                                        block
                                        w-full
                                    "
                                />
                            </div>

                            <div class="mt-4">
                                <jet-label
                                    for="first_paragraph"
                                    value="Primer Parrafo"
                                />
                                <ckeditor
                                    id="first_paragraph"
                                    :editor="editor"
                                    v-model="form.first_paragraph"
                                    :config="editorConfig"
                                ></ckeditor>
                            </div>

                            <div class="mt-4">
                                <jet-label
                                    for="second_paragraph"
                                    value="Segundo Parrafo (Opcional)"
                                />
                                <ckeditor
                                    id="second_paragraph"
                                    :editor="editor"
                                    v-model="form.second_paragraph"
                                    :config="editorConfig"
                                ></ckeditor>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <jet-button
                                    type="submit"
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Enviar
                                </jet-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import AppLayout from "@/Layouts/AppLayout";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import Multiselect from "@vueform/multiselect";

export default {
    props: {
        investors: {
            type: Array,
            required: true,
        },
    },
    mounted() {
        this.investors.forEach((investor) => {
            this.selectOptions.options.push({
                value: investor.id,
                label: investor.name,
            });
        });
    },
    data() {
        return {
            selectOptions: {
                mode: "tags",
                options: [{ value: "all", label: "Todos" }],
                searchable: true,
                createTag: true,
                noResultsText: "No hay mas resultados",
                required : true
            },
            editor: ClassicEditor,
            editorConfig: {
                height: 500,
                toolbar: {
                    items: [
                        "bold",
                        "italic",
                        "link",
                        "blockQuote",
                        "|",
                        "bulletedList",
                        "numberedList",
                        "|",
                        "undo",
                        "redo",
                    ],
                },
            },
            form: this.$inertia.form({
                title: "",
                first_paragraph: "",
                second_paragraph: "",
                investors: ["all"],
            }),
        };
    },

    components: {
        AppLayout,
        JetInput,
        JetButton,
        JetLabel,
        JetValidationErrors,
        Multiselect,
    },

    methods: {
        submit() {
            this.form.post(this.route("investor.mailsend"));
        },
    },
};
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
