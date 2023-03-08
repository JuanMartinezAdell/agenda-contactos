<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import DropdownVue from '../../ComponentsNew/DropdownVue.vue';
    import Pagination from '../../ComponentsNew/PaginationVue.vue';
    import Input from '@/ComponentsNew/TextInput.vue';
    import {Link} from '@inertiajs/inertia-vue3';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import SecundaryButton from '@/ComponentsNew/SecundaryButton.vue';
    import EditButton from '@/ComponentsNew/EditButton.vue';
    export default {
        data() {
            return {
                search: this.filters.search,
            }
        },
        watch: {
            search($value) {
                this.$inertia.get('/contacts', { search: $value } , { preserveState: true })
            }
        },
    }
</script>

<script setup>
    defineProps({
        filters: Object,
        contacts: Array,
     })
</script>

<template>
   <AppLayout title="Contactos">
        <template #header>
                <div class="flex justify-between items-center">
                    <div class="font-semibold text-xl text-gray-800 leading-tight">
                        <h2>Contactos</h2>
                    </div>
                </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex justify-between items-center pb-4 bg-white dark:bg-gray-900">
                    <div>
                        <Input for="name" value="Buscador de contactos" />
                        <DropdownVue  align="right" width="100" overflow="overflow-y-auto" maxheight="300">
                            <template #trigger>
                                <div class="relative relative grow">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <Input v-model="search" type="search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Busca contactos" />
                                </div>
                            </template>
                        </DropdownVue>
                    </div>
                    <div class="flex justify-end">
                        <Link href="/contacts/create">
                            <SecundaryButton class="ml-4 mt-4">Nuevo Contacto</SecundaryButton>
                        </Link>
                    </div>
                </div>
                <div class="overflow-x-auto relative">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Nombre
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Rol
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Ubicación
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Telefonos
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Código
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Nota
                                </th>
                                <th scope="col" class="py-3 px-6">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="contact in contacts.data" :key="contact.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10">
                                            <Link :href="'/contacts/'+contact.id+'/edit'">
                                                <img class="w-full h-full rounded-full" src="../../../image/estrella.png" alt="" />
                                            </Link>
                                        </div>
                                    </div>
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">{{ contact.name }}</div>
                                        <div class="font-normal text-gray-500">{{ contact.email }}</div>
                                    </div>
                                </th>
                                <td class="py-4 px-6">
                                    <div class="text-base font-semibold">{{ contact.organization.name }}</div>
                                    <div class="font-normal text-gray-500">{{ contact.position.name }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="text-base font-semibold">{{ contact.service.name }}</div>
                                    <div class="font-normal text-gray-500">{{ contact.location.name }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="text-base font-semibold">{{ contact.phone }}</div>
                                    <div class="font-normal text-gray-500">{{ contact.short_phone }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    {{ contact.phone_code }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ contact.description }}
                                </td>
                                <td class="py-4 px-6 pb-8">
                                    <Link :href="'/contacts/'+contact.id+'/edit'">
                                        <button type="button" class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Icon description</span>
                                        </button>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :pagination="contacts"></pagination>
                </div>
            </div>

                </div>
            </div>
        </div>

        <template #footer></template>
    </AppLayout>
</template>

<style>
</style>
