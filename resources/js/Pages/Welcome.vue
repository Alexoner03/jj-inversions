<template>
    <div
        class="relative bg-img flex items-top justify-center min-h-screen w-screen h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
    >
        <div
            v-if="canLogin"
            class="hidden fixed top-0 right-0 px-6 py-4 sm:block bg-layer w-full text-right"
        >
            <inertia-link
                v-if="$page.props.user"
                :href="route('user.index')"
                class="text-sm text-gray-700 underline"
            >
                Ingresar
            </inertia-link>

            <template v-else>
                <inertia-link
                    :href="route('login')"
                    class="text-lg text-black font-bold underline mr-4"
                >
                    Iniciar Sesión
                </inertia-link>
                <inertia-link
                    v-if="canRegister"
                    :href="route('register')"
                    class="text-lg text-black font-bold underline"
                >
                    Registrarse
                </inertia-link>
            </template>
        </div>

        <div class="h-full w-full">
            <div class="container mx-auto h-full">
                <div
                    class="flex flex-col items-center justify-center w-full h-full"
                >
                    <div class="mb-4">
                        <img src="/img/logo.png" class="h-32 w-32" alt="">
                    </div>
                    <h1
                        class="text-7xl font-black text-center text-indigo-900 bg-opacity-50 bg-white"
                    >
                        GROUP JJ INVERSIONES SAC <br />
                        SISTEMA ADMINISTRADOR
                    </h1>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg-img {
    background-image: url("/img/welcome-bg.jpg");
    background-size: cover;
    background-position: center;
}

.bg-layer {
    background-color: rgba(255, 255, 255, 0.9);
}

.bg-gray-100 {
    background-color: #f7fafc;
    background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.border-gray-200 {
    border-color: #edf2f7;
    border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
    color: #a0aec0;
    color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
    color: #718096;
    color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
    color: #4a5568;
    color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
    color: #1a202c;
    color: rgba(26, 32, 44, var(--tw-text-opacity));
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-gray-800 {
        background-color: #2d3748;
        background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
    }

    .dark\:bg-gray-900 {
        background-color: #1a202c;
        background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
    }

    .dark\:border-gray-700 {
        border-color: #4a5568;
        border-color: rgba(74, 85, 104, var(--tw-border-opacity));
    }

    .dark\:text-white {
        color: #fff;
        color: rgba(255, 255, 255, var(--tw-text-opacity));
    }

    .dark\:text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }
}
</style>

<script>
import ActionSection from "../Jetstream/ActionSection.vue";
export default {
    components: { ActionSection },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
};
</script>
