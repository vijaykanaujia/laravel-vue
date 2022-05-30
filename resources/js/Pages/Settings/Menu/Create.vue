<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeError from '@/Components/InputError.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {
    Head,
    useForm,
    Link
} from '@inertiajs/inertia-vue3';

const props = defineProps({
    'title': String,
    'parent_menu': Object,
    'token' : String
});
const form = useForm({
    title: '',
    description: '',
    icon: '',
    page: '',
    parent_id: 0,
    position: 0,
    status: 1,
    _token: props.token
});

const submit = () => {
    form.post(route('menu.store'), {
        onSuccess: () => {
            form.reset()
        },
        onError: (errors) => {
            debugger
        },
    });
};
</script>

<template>
<Head :title="title" />

<BreezeAuthenticatedLayout>
    <template #header>
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{title}}
                </h2>
            </div>
            <div>
                <Link :href="route('menu.index')">
                <BreezeButton class="ml-4 float-right">
                    Back
                </BreezeButton>
                </Link>
            </div>
        </div>
    </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <BreezeValidationErrors class="mb-4" />
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-4 gap-2">

                            <div>
                                <BreezeLabel for="title" value="Menu Title" />
                                <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" autocomplete="title" />
                                <BreezeError :message="form.errors.title" />
                            </div>

                            <div>
                                <BreezeLabel for="page" value="Page" />
                                <BreezeInput id="page" type="text" class="mt-1 block w-full" v-model="form.page" autocomplete="page" />
                                <BreezeError :message="form.errors.page" />
                            </div>

                            <div class="col-span-4">

                                <div class="flex items-center justify-end">
                                    <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Save
                                    </BreezeButton>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</BreezeAuthenticatedLayout>
</template>
