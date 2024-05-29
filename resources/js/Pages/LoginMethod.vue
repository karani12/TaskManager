<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import LoginLink from '@/Components/AuthLink.vue';
import PrimaryButton from '@/Components/IconButton.vue';
import { Head, Link, router } from '@inertiajs/vue3';
const handleGoogleLogin = () => {
    window.location.href = route('login.google');
}

</script>

<template>
    <GuestLayout>
        <section>
            
        </section>

        <Head title="Login Method" />
        <div class="content space-y-2 ">
            <h1 class="text-black text-xl font-bold">Create Account</h1>
            <p class="text-gray-400">Create an account to start managing your tasks.</p>
        </div>
        <div class="choose-method space-y-4 py-3">
            <PrimaryButton text="Login with Google" @click="handleGoogleLogin" extraClasses="bg-gray-50">
                <template #icon>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_2_645)">
                            <path
                                d="M23.9875 12.2245C23.9875 11.2413 23.9058 10.5238 23.7291 9.77966H12.239V14.2176H18.9834C18.8475 15.3205 18.1132 16.9815 16.4815 18.0976L16.4586 18.2462L20.0916 20.9964L20.3433 21.0209C22.6548 18.9347 23.9875 15.8653 23.9875 12.2245Z"
                                fill="#4285F4" />
                            <path
                                d="M12.239 23.9176C15.5432 23.9176 18.3171 22.8545 20.3432 21.0209L16.4815 18.0976C15.4481 18.8018 14.0611 19.2934 12.239 19.2934C9.00276 19.2934 6.25604 17.2074 5.27691 14.324L5.13339 14.3359L1.3558 17.1927L1.3064 17.3269C3.31884 21.2334 7.45256 23.9176 12.239 23.9176Z"
                                fill="#34A853" />
                            <path
                                d="M5.27697 14.3239C5.01861 13.5798 4.8691 12.7825 4.8691 11.9587C4.8691 11.1349 5.01861 10.3376 5.26337 9.59354L5.25653 9.43507L1.43159 6.53235L1.30645 6.59052C0.477024 8.21162 0.00109863 10.032 0.00109863 11.9587C0.00109863 13.8854 0.477024 15.7058 1.30645 17.3269L5.27697 14.3239Z"
                                fill="#FBBC05" />
                            <path
                                d="M12.239 4.62403C14.537 4.62403 16.0871 5.59401 16.971 6.40461L20.4248 3.10928C18.3036 1.1826 15.5432 0 12.239 0C7.45256 0 3.31884 2.68406 1.3064 6.59056L5.26332 9.59359C6.25604 6.7102 9.00276 4.62403 12.239 4.62403Z"
                                fill="#EB4335" />
                        </g>
                        <defs>
                            <clipPath id="clip0_2_645">
                                <rect width="24" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </template>
            </PrimaryButton>
            <div class="reg">

                <Link href="/register">
                <PrimaryButton text="Continue With Email" extraClasses="bg-primary-600 text-white" />
                </Link>
            </div>
            <LoginLink href="/login" question="Already have an account?" linkText="Log in" />
        </div>


    </GuestLayout>
</template>