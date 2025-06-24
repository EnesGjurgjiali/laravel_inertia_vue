<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onError: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="Register" />
    <h1 class="title">Register a new account</h1>

    <div class="w-2/4 mx-auto">
        <form @submit.prevent="submit">
            <div class="mb-6">
                <label>Name</label>
                <input
                    type="text"
                    v-model="form.name"
                    class="w-full px-4 py-2 border rounded-lg"
                    :class="{ 'border-red-500': form.errors.name }"
                />
                <small class="text-red-500 text-sm mt-1 block">{{
                    form.errors.name
                }}</small>
            </div>

            <div class="mb-6">
                <label>Email</label>
                <input
                    type="email"
                    v-model="form.email"
                    class="w-full px-4 py-2 border rounded-lg"
                    :class="{ 'border-red-500': form.errors.email }"
                />
                <small class="text-red-500 text-sm mt-1 block">{{
                    form.errors.email
                }}</small>
            </div>

            <div class="mb-6">
                <label>Password</label>
                <input
                    type="password"
                    v-model="form.password"
                    class="w-full px-4 py-2 border rounded-lg"
                    :class="{ 'border-red-500': form.errors.password }"
                />
                <small class="text-red-500 text-sm mt-1 block">{{
                    form.errors.password
                }}</small>
            </div>

            <div class="mb-6">
                <label>Confirm Password</label>
                <input
                    type="password"
                    v-model="form.password_confirmation"
                    class="w-full px-4 py-2 border rounded-lg"
                />
            </div>

            <div class="">
                <p class="text-slate-600 mb-2">
                    Already a user? <a href="#" class="text-link">Login</a>
                </p>
                <button
                    type="submit"
                    class="primary-btn"
                    :disabled="form.processing"
                >
                    {{ form.processing ? "Registering..." : "Register" }}
                </button>
            </div>
        </form>
    </div>
</template>
