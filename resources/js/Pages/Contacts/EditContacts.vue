<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import SecundaryButton from '@/ComponentsNew/SecundaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
  import Dropdown from '@/Components/Dropdown.vue';
  import DropdownLink from '@/Components/DropdownLink.vue';
  import { reactive } from '@vue/reactivity';
  import DeleteButton from '@/ComponentsNew/DeleteButton.vue';


    const props = defineProps({
            contact: Object,
            organizations: Object,
            positions: Object,
            services: Object,
            locations: Object,
    });


    const form = useForm ({
        id: props.contact.id,
        name: props.contact.name,
        organization_id: props.contact.organization_id,
        position_id: props.contact.position_id,
        service_id: props.contact.service_id,
        location_id: props.contact.location_id,
        phone: props.contact.phone,
        short_phone: props.contact.short_phone,
        phone_code: props.contact.phone_code,
        email: props.contact.email,
        description: props.contact.description,
    });

    const submit = () =>{
        form.put('/contacts/update', form.id);
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
                    <span class="text-indigo-700 justify-center mb-2">Editar </span> / Contacto
                </h1>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="mt-4 mx-8">
                                <Input for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Nombre Apellido1 Apellido2"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div class="mt-4 mx-8">
                                <InputLabel for="email" value="Email" />
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    placeholder="cuenta@gmail.com"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                            <div class="mt-4 mx-8">
                                <Label>
                                    Empresa
                                    <select v-model="form.organization_id" class="form.control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                                        <option value="" disabled selected>Selecciona Empresa</option>
                                        <option v-for="organization in organizations" :value="organization.id" :key="organization.id">{{ organization.name }}</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.organization_id" />
                                </Label>
                            </div>
                            <div class="mt-4 mx-8">
                                <Label>
                                    Puesto
                                    <select v-model="form.position_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        <option value="" disabled selected>Selecciona puesto</option>
                                        <option v-for="position in positions" :value="position.id" :key="position.id">{{ position.name }}</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.position_id" />
                                </Label>
                            </div>
                            <div class="mt-4 mx-8">
                                <Label>
                                    Servicio
                                    <select v-model="form.service_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        <option value="" disabled selected>Selecciona servicio al que pertenece</option>
                                        <option v-for="service in services" :value="service.id" :key="service.id">{{ service.name }}</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.service_id" />
                                </Label>
                            </div>
                            <div class="mt-4 mx-8">
                                <Label>
                                    Localizacion
                                    <select v-model="form.location_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        <option value="" disabled selected>Selecciona Localizacion</option>
                                        <option v-for="location in locations" :value="location.id" :key="location.id">{{ location.name }}</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.location_id" />
                                </Label>
                            </div>
                            <div class="mt-4 mx-8">
                                <InputLabel for="phone" value="Telefono" />
                                <TextInput
                                    id="phone"
                                    v-model="form.phone"
                                    type="tel"
                                    class="mt-1 block w-full"
                                    placeholder="Fijo o móvil"
                                    required
                                    autofocus
                                    autocomplete="tel"
                                />
                                <InputError class="mt-2" :message="form.errors.phone" />
                            </div>
                            <div class="mt-4 mx-8">
                                <InputLabel for="short_phone" value="Telefono Corto" />
                                <TextInput
                                    id="short_phone"
                                    v-model="form.short_phone"
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
                                <InputError class="mt-2" :message="form.errors.short_phone" />
                            </div>
                            <div class="mt-4 mx-8">
                                <InputLabel for="phone_code" value="Codigo telefono" />
                                <TextInput
                                    id="phone_code"
                                    v-model="form.phone_code"
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

                                <InputError class="mt-2" :message="form.errors.phone_code" />
                            </div>
                            <div class="mt-4 mx-8">
                                <InputLabel for="description" value="Notas" />
                                <TextInput
                                    id="description"
                                    v-model="form.description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Escribir Nota"
                                    required
                                    autofocus
                                    autocomplete="text"
                                    maxlength="100"
                                />
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div class="flex m-8 mt-4">
                                <Link :href="'/contacts'">
                                    <button type="button" class=" text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800">
                                        <svg class="w-6 h-6 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                                        <span class="sr-only">Icon description</span>
                                    </button>
                                </Link>
                            </div>
                            <div class="flex m-8 mt-4 justify-end">
                                    <PrimaryButton type="submit" class="ml-4 mt-4 ">
                                        Actualizar
                                    </PrimaryButton>
                                    <Link :href="'/contacts/'+contact.id+'/delete'">
                                            <DeleteButton class="ml-4 mt-4 text-center">Borrar Contacto</DeleteButton>
                                    </Link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <template #footer></template>
    </AppLayout>
</template>

<style>

</style>
