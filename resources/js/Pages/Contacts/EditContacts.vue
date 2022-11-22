<script>
    import AppLayout from '@/Layouts/AppLayout.vue';

    export default {
        components: {
            AppLayout,
        },

        props: {
            contact: {
                type: Object,
                required: true,
            },
        }
    }
</script>

<template>
    <AppLayout title="Contactos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contactos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h1>Editar Contactos</h1>

                    <pre>
                        {{ contact }}
                    </pre>
                </div>
            </div>
        </div>

        <template #footer></template>
    </AppLayout>
</template>

<style>

</style>
