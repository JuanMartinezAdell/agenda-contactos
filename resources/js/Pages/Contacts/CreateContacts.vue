<script>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import Dropdown from '@/Components/Dropdown.vue';
    import DropdownLink from '@/Components/DropdownLink.vue';
    import { Inertia } from '@inertiajs/inertia';
    import { reactive } from '@vue/reactivity';
    import SecundaryButton from '@/ComponentsNew/SecundaryButton.vue';

    export default {
        components: {
            AppLayout,
            InputError,
            InputLabel,
            PrimaryButton,
            SecundaryButton,
            TextInput,
            Dropdown,
            DropdownLink
        },

        props: {
                organizations: Array,
                positions: Array,
                services: Array,
                locations: Array,
            },

        data() {
            return {
                contact: {
                    name: '',
                    organization_id: '',
                    position_id: '',
                    service_id: '',
                    location_id: '',
                    phone: '',
                    short_phone: '',
                    phone_code: '',
                    email: '',
                    description: '',
                }
            }
        },

        methods : {
            store() {
                this.$inertia.post(this.route('contacts.store'), this.contact);
            }
        }

    }

</script>

<template>
    <AppLayout title="Contactos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                 Contacto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    <span class="text-indigo-700 justify-center mb-2">Crear /</span> Contacto
                </h1>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="mt-4 mx-8">
                                <Input for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    v-model="contact.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Nombre Apellido1 Apellido2"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError class="mt-2" />
                            </div>
                            <div class="mt-4 mx-8">
                                <InputLabel for="email" value="Email" />
                                <TextInput
                                    id="email"
                                    v-model="contact.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    placeholder="cuenta@gmail.com"
                                    required
                                />
                                <InputError class="mt-2" />
                            </div>
                            <div class="mt-4 mx-8">
                                <Dropdown width="60">
                                    <template #trigger>
                                        <Label>
                                            Empresa
                                            <select v-model="contact.organization_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="" disabled selected>Selecciona una Empresa</option>
                                                <option v-for="organization in organizations" :value="organization.id" :key="organization.id">{{ organization.name }}</option>
                                                <InputError class="mt-2" />
                                            </select>
                                        </Label>
                                    </template>
                                </Dropdown>
                            </div>
                            <div class="mt-4 mx-8">
                                <Dropdown width="60">
                                    <template #trigger>
                                        <Label>
                                            Puesto
                                            <select v-model="contact.position_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="" disabled selected>Selecciona el pusto de trabajo</option>
                                                <option v-for="position in positions" :value="position.id" :key="position.id">{{ position.name }}</option>
                                                <InputError class="mt-2" />
                                            </select>
                                        </Label>
                                    </template>
                                </Dropdown>
                            </div>
                            <div class="mt-4 mx-8">
                                <Dropdown width="60">
                                    <template #trigger>
                                        <Label>
                                            Servicio
                                            <select v-model="contact.service_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="" disabled selected>Selecciona el servico</option>
                                                <option v-for="service in services" :value="service.id" :key="service.id">{{ service.name }}</option>
                                                <InputError class="mt-2" />
                                            </select>
                                        </Label>
                                    </template>
                                </Dropdown>
                            </div>
                            <div class="mt-4 mx-8">
                                <Dropdown width="60">
                                    <template #trigger>
                                        <Label>
                                            Localizacion
                                            <select v-model="contact.location_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                                <option value="" disabled selected>Selecciona una Localizacion</option>
                                                <option v-for="location in locations" :value="location.id" :key="location.id">{{ location.name }}</option>
                                                <InputError class="mt-2" />
                                            </select>
                                        </Label>
                                    </template>
                                </Dropdown>
                            </div>
                            <div class="mt-4 mx-8">
                                <InputLabel for="phone" value="Telefono" />
                                <TextInput
                                    id="phone"
                                    v-model="contact.phone"
                                    type="tel"
                                    class="mt-1 block w-full"
                                    placeholder="Fijo o móvil"
                                    required
                                    autofocus
                                    autocomplete="tel"
                                />
                                <InputError class="mt-2" />
                            </div>
                            <div class="mt-4 mx-8">
                                <InputLabel for="short_phone" value="Telefono Corto" />
                                <TextInput
                                    id="short_phone"
                                    v-model="contact.short_phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="text"
                                    placeholder="Escribir Numero Corto"
                                    minlength="6"
                                    maxlength="6"
                                    pattern="[0-9]+"
                                />
                                <InputError class="mt-2"  />
                            </div>
                            <div class="mt-4 mx-8">
                                <InputLabel for="phone_code" value="Codigo telefono" />
                                <TextInput
                                    id="phone_code"
                                    v-model="contact.phone_code"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="text"
                                    placeholder="Escribir Pin"
                                    minlength="4"
                                    maxlength="4"
                                    pattern="[0-9]+"
                                />
                                <InputError class="mt-2" />
                            </div>
                            <div class="mt-4 mx-8">
                                <InputLabel for="description" value="Notas" />
                                <TextInput
                                    id="description"
                                    v-model="contact.description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Escribir Nota"
                                    required
                                    autofocus
                                    autocomplete="text"
                                    maxlength="100"
                                />
                                <InputError class="mt-2" />
                            </div>
                        </div>
                        <div class="flex justify-end m-8">
                                <SecundaryButton class="ml-4 mt-4" @click="store">
                                    Crear
                                </SecundaryButton>
                        </div>
                </div>
            </div>
        </div>
        <template #footer></template>
    </AppLayout>
</template>

<style>

</style>
