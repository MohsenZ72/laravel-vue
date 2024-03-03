<template>
    <div>
        <section class="container" v-if="component === 'login'">
            <h1 class="container__heade">login</h1>
            <div class="container__inputs">
                <div>
                    <p>email</p>
                    <input
                        type="text"
                        v-model="userInfo.email"
                        :class="{ error: errors.includes('email') }"
                    />
                </div>
                <div>
                    <p>password</p>
                    <input type="password" v-model="userInfo.password" />
                </div>
                <div class="submit" @click="login">
                    <button>login</button>
                </div>
                <div
                    class="container__inputs__register"
                    @click="changecomponent('register')"
                >
                    <p>register</p>
                </div>
            </div>
        </section>
        <section class="container" v-else>
            <h1 class="container__heade">register</h1>
            <div class="container__inputs">
                <div>
                    <p>email</p>
                    <input
                        v-model="userInfo.email"
                        type="text"
                        :class="{ error: errors.includes('email') }"
                    />
                </div>
                <div>
                    <p>name</p>
                    <input
                        v-model="userInfo.name"
                        type="text"
                        :class="{ error: errors.includes('name') }"
                    />
                </div>
                <div>
                    <p>last name</p>
                    <input
                        v-model="userInfo.lastName"
                        type="text"
                        :class="{ error: errors.includes('lastName') }"
                    />
                </div>
                <div>
                    <p>phone number</p>
                    <input
                        v-model="userInfo.phoneNumber"
                        type="text"
                        :class="{ error: errors.includes('phonenumber') }"
                    />
                </div>
                <div>
                    <p>password</p>
                    <input
                        v-model="userInfo.password"
                        type="password"
                        :class="{
                            error:
                                errors.includes('pass') ||
                                errors.includes('confirmPass') ||
                                errors.includes('passlenght'),
                        }"
                    />
                </div>
                <div>
                    <p>confirm password</p>
                    <input
                        v-model="userInfo.confirmPass"
                        type="password"
                        :class="{
                            error:
                                errors.includes('pass') ||
                                errors.includes('confirmPass') ||
                                errors.includes('passlenght'),
                        }"
                    />
                </div>
                <div class="submit" @click="register">
                    <button>register</button>
                </div>
                <div
                    class="container__inputs__register"
                    @click="changecomponent('login')"
                >
                    <p>login</p>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { registerService, loginService } from "../../services/auth";
const component = ref("login");

const userInfo = ref({
    email: "",
    name: "",
    lastName: "",
    phoneNumber: "",
    password: "",
    confirmPass: "",
});

const errors = ref([]);

const changecomponent = (val) => {
    errors.value = [];
    component.value = val;
};

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const iranPhoneNumberRegex = /^(\+98|0)?9\d{9}$/;

const login = async () => {
    errors.value = [];

    loginValidation();
    if (errors.value.length === 0) {
        try {
            await loginService(userInfo.value);
            window.location = "/users";
        } catch (e) {
            alert(e.message);
        }
    }
};

const register = async () => {
    errors.value = [];
    registerValidation();
    if (errors.value.length === 0) {
        try {
            await registerService(userInfo.value);
            window.location = "/users";
        } catch (e) {
            alert(e.message);
        }
    }
};

const loginValidation = () => {
    if (!userInfo.value.email || !emailRegex.test(userInfo.value.email)) {
        errors.value.push("email");
    }
    if (!userInfo.value.password) {
        errors.value.push("pass");
    }
};

const registerValidation = () => {
    if (!userInfo.value.email || !emailRegex.test(userInfo.value.email)) {
        errors.value.push("email");
    }
    if (!userInfo.value.name) {
        errors.value.push("name");
    }
    if (
        !userInfo.value.phoneNumber ||
        !iranPhoneNumberRegex.test(userInfo.value.phoneNumber)
    ) {
        errors.value.push("phonenumber");
    }
    if (!userInfo.value.lastName) {
        errors.value.push("lastName");
    }
    if (!userInfo.value.password || !userInfo.value.confirmPass) {
        errors.value.push("pass");
    }
    if (userInfo.value.password !== userInfo.value.confirmPass) {
        errors.value.push("confirmPass");
    }
    if (userInfo.value.password.length < 6) {
        errors.value.push("passlenght");
    }
};
</script>

<style lang="scss">
@import "login";
</style>
