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
        components: {
            AppLayout,
            DropdownVue,
            Pagination,
            Input,
            Link,
            PrimaryButton,
            SecundaryButton,
            EditButton
        },
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
        props: {
            filters: Object,
            contacts: Object,
        }
    }
</script>

<template>
   <AppLayout title="Contactos">
        <template #header>
                <div class="flex justify-between items-center">
                    <div class="font-semibold text-xl text-gray-800 leading-tight">
                        <h2>Contactos</h2>
                    </div>
                    <div>
                        <DropdownVue  align="right" width="100" overflow="overflow-y-auto" maxheight="300">
                            <template #trigger>
                                <div class="relative relative grow">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <Input v-model="search" type="search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Busca contactos" />
                                    <!-- {{ search }} -->
                                </div>
                            </template>

                            <!--template #content>
                                <a href="" class="block flex items-center py-2 px-3 hover:bg-gray-100">
                                    <img src="" alt="Juan">
                                    <div class="ml-2">
                                        <span class="block font-bold text-gray-700 text-sm">Juan Martinez Adell</span>
                                        <span class="text-sm font-light text-gray-400 ">Informatica</span>
                                    </div>
                                </a>
                            </template -->
                        </DropdownVue>
                    </div>
                </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            <!-- div class="overflow-x-auto relative shadow-md sm:rounded-lg" -->
            <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex justify-between items-center pb-4 bg-white dark:bg-gray-900">
                    <div class="w-64 py-4 px-6 pb-8">
                        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Todos los contactos</option>
                            <option value="HOSP">Hospital</option>
                            <option value="PRIM">Primaria</option>
                            <option value="EX">Externos</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <Link :href="route('contacts.create')">
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
                                    Ubicaci??n
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Telefonos
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    C??digo
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
                                            <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />
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
                                    <Link href="#">
                                        <EditButton class="ml-4 mt-4 text-center">></EditButton>
                                    </Link>
                                    <!-- a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</!-->
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
