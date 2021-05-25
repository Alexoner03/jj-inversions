<template>
    <div class="bg-white w-full rounded-lg shadow-xl">
        <div class="p-4 border-b">
            <h2 class="text-2xl">Datos del Inversionista</h2>
        </div>
        <div>
            <div
                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
            >
                <p class="text-gray-600 font-bold">Nombres Completos</p>
                <p>{{ investor.name }} {{ investor.last_name }}</p>
            </div>
            <div
                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
            >
                <p class="text-gray-600 font-bold">Correo Eléctronico</p>
                <p>
                    {{ investor.email }}
                </p>
            </div>
            <div
                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
            >
                <p class="text-gray-600 font-bold">Documento de Identidad</p>
                <p>
                    {{ investor.dni }}
                </p>
            </div>
            <div
                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
            >
                <p class="text-gray-600 font-bold">Teléfono</p>
                <p>
                    {{ investor.phone }}
                </p>
            </div>
            <div
                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
            >
                <p class="text-gray-600 font-bold">Fecha de Registro</p>
                <p>
                    {{ investor.created_at }}
                </p>
            </div>
            <div
                class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4"
            >
                <p class="text-gray-600 font-bold">Cantidad de Inversiones</p>
                <p>
                    {{ investmentsLength }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : {
        investor : {
            type : Object,
            required : true
        },
        investmentsLength : Number
    }
};
</script>

<style></style>
