import { createWebHistory, createRouter } from "vue-router";
import login from "../components/login/login.vue";
import users from "../components/users/users.vue";
// Define default routes
const defaultRoutes = [
    {
        path: "/",
        component: login,
    },
    {
        path: "/users",
        component: users,
    },
];

// Create router instance
const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: "active",
    routes: defaultRoutes, // Use 'routes' instead of 'defaultroutes'
});

export default router;
