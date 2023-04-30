<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import Welcome from '@/Components/Welcome.vue';
    import { defineComponent } from '@vue/runtime-core';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Inicio
            </h2>
        </template>

        <div class="py-12">
            <div class="p-8 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-none">
                <!-- img class=" " src="../../image/AgendaGif.gif"  alt=""/ -->
                <div class="rounded-xl flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat bg-gradient-to-r from-indigo-400 via-purple-400 to-orange-300" style="background-image:url('https://images.unsplash.com/photo-1499123785106-343e69e68db1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1748&q=80')">
                    <div class="max-w-6xl p-8 mx-auto sm:px-6 lg:px-8">
                            <div class="rounded-xl bg-gray-800 bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
                                <div class="text-white">
                                    <div class="p-8">
                                    <div class="flex items-center">
                                        <svg
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                            class="w-8 h-8 text-white-500">
                                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                            <div class="ml-4 text-xl leading-7 font-semibold">
                                                <a :href="route('contacts.index')" class="underline text-white-900 dark:text-gray">Agenda de Contactos</a>
                                            </div>
                                    </div>

                                    <div class="ml-12 p-8">
                                        <div class="mt-2 text-gray dark:text-gray-400 text-lg">
                                            <p>Agenda de contactos por perfiles.<br>
                                            Busca y agrega tus contactos por ubicacion y cargo.</p>
                                        </div>
                                    </div>

                                    <div class="bg-[../../image/CortaAtalaya.jpg] bg-cover bg-fixed">

                                    </div>
                            </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    <template #footer></template>
    </AppLayout>
</template>
