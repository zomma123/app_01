import {
    createWebHistory,
    createRouter
} from "vue-router";

import store from "../pages/store.vue";
import pos from "../pages/pos.vue";
import transection from "../pages/transection.vue";
import report from "../pages/report.vue";
import login from "../pages/login.vue";
import register from "../pages/register.vue";

export const routes = [{
        name: "login_page1",
        path: "/",
        component: login
    },
    {
        name: "login_page",
        path: "/login",
        component: login
    },
    {
        name: "register_page",
        path: "/register",
        component: register
    },
    {
        name: "store_page",
        path: "/store",
        component: store
    },
    {
        name: "pos_page",
        path: "/pos",
        component: pos
    },
    {
        name: "transection_page",
        path: "/transection",
        component: transection
    },
    {
        name: "report_page",
        path: "/report",
        component: report
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes: routes,
    scrollBehavior() {
        window.scrollTo(0, 0);
    },
});
export default router
