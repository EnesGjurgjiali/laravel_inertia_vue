<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "../Components/TextInput.vue";

const form = useForm({
    email: null,
    password: null,
    remember: null,
});

const submit = () => {
    form.post(route("login"), {
        onError: () => form.reset("password", "remember"),
    });
};
</script>

<template>
    <Head title="Login" />
    <h1 class="title">Login to your account</h1>

    <div class="w-2/4 mx-auto">
        <form @submit.prevent="submit">
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

            <!-- Remember me button -->
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        id="remember"
                        v-model="form.remember"
                    />
                    <label for="remember" class="underline cursor-pointer"
                        >Remember me</label
                    >
                </div>

                <p class="text-slate-600">
                    Need an account?
                    <a :href="route('register')" class="text-link">Register</a>
                </p>
            </div>

            <!-- Submit button -->
            <div class="flex items-center gap-2">
                <button
                    type="submit"
                    class="primary-btn"
                    :disabled="form.processing"
                >
                    {{ form.processing ? "Logging in..." : "Login" }}
                </button>
            </div>
        </form>
    </div>
</template>
