<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "../Components/TextInput.vue";

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    avatar: null,
    preview: null,
});
const change = (e) => {
    form.avatar = e.target.files[0];
    form.preview = URL.createObjectURL(form.avatar);
};

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
            <!-- Upload Avatar input -->
            <div class="grid place-items-center">
                <div
                    class="relative w-28 h-28 rounded-full overflow-hidden border border-slate-300"
                >
                    <label
                        for="avatar"
                        class="absolute inset-0 grid content-end cursor-pointer"
                        ><span class="bg-white/70 pb-2 text-center" > Avatar </span></label
                    >
                    <input
                        type="file"
                        id="avatar"
                        class="mb-4"
                        @input="change"
                        hidden
                    />
                    <img class="object-cover w-28 h-28" :src="form.preview ?? 'storage/avatars/default.png'" alt="Avatar" />
                </div>
                <p>{{ form.errors.avatar }}</p>
            </div>
            <!-- Name input -->
            <TextInput
                name="name"
                v-model="form.name"
                :message="form.errors.name"
            />
            <!-- Email input -->
            <TextInput
                name="email"
                type="email"
                v-model="form.email"
                :message="form.errors.email"
            />
            <!-- Password input -->
            <TextInput
                name="password"
                type="password"
                v-model="form.password"
                :message="form.errors.password"
            />
            <!-- Confirm Password input -->
            <TextInput
                name="confirm password"
                v-model="form.password_confirmation"
            />
            <!-- Submit button -->
            <div class="">
                <p class="text-slate-600 mb-2">
                    Already a user?
                    <a :href="route('login')" class="text-link">Login</a>
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
