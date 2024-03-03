<template>
    <div>
        <div class="flex">
            <h1>wellcom to user panle {{ currentuser.name }}</h1>
            <p @click="create">create</p>
        </div>
        <ul class="ul">
            <!-- <li>
                <p>name</p>
                <p>last name</p>
                <p>phone number</p>
                <p>email</p>
                <p>role</p>
            </li> -->
            <li v-for="user in users" :key="user.id">
                <p>{{ user.name }}</p>
                <p>{{ user.last_name }}</p>
                <p>{{ user.phone_number }}</p>
                <p>{{ user.email }}</p>
                <select
                    :disabled="currentuser.id === user.id"
                    :value="user.role"
                    @change="updateRole(user.id, $event)"
                >
                    <option value="Admin">Admin</option>
                    <option value="Customer">Customer</option>
                    <option value="Operator">Operator</option>
                </select>

                <button
                    class="delete"
                    v-if="currentuser.id !== user.id"
                    @click="deleteUser(user.id)"
                >
                    delete
                </button>
                <button
                    v-if="user.role === 'Admin'"
                    class="cache"
                    @click="cleanCatch()"
                >
                    clean cache
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import {
    cleanCatchService,
    updateUserService,
    deleteUserServece,
} from "../../services/users";
import router from "../../router"; // Import router instance

const users = ref([]);
const currentuser = ref([]);
onMounted(() => {
    users.value = window.users.users;
    currentuser.value = window.users.current;
});

const create = async () => {
    router.push("/");
};
const updateRole = async (id, e) => {
    try {
        await updateUserService({ id: id, val: e.target.value });
    } finally {
        alert("change successfully");
    }
};

const deleteUser = async (id) => {
    try {
        await deleteUserServece(id);
    } finally {
        window.location.reload();
    }
};

const cleanCatch = async () => {
    try {
        await cleanCatchService();
    } finally {
        alert("done");
    }
};
</script>
<style lang="scss">
@import "users";
</style>
