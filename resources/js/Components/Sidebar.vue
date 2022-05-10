<template>
    <div class="flex flex-col gap-y-4 items-center py-8 w-24 bg-gray-900">
        <button class="p-2 bg-opacity-20 rounded-xl bg-primary">
            <StoreIcon />
        </button>
        <div class="flex flex-col gap-y-4 items-end self-end">
            <div
                v-for="(menu, i) in menus"
                :key="i"
                :class="
                    menu.link == route().current()
                        ? 'bg-gray-800 rounded-l-xl relative before:absolute before:w-4 before:h-8 before:-top-8 before:rounded-br-xl before:right-0 before:shadow-inverse-top  after:absolute after:w-4 after:h-8 after:-bottom-8 after:rounded-tr-xl after:right-0 after:shadow-inverse-bottom'
                        : ''
                "
            >
                <NavLink
                    v-on:click="activeMenu = menu.name"
                    :href="route(menu.link)"
                    :active="route().current(menu.link)"
                    :method="menu.method"
                    :permission="menu.permission"
                >
                    <Component :is="menu.icon" class="w-6 h-6 fill-current" />
                </NavLink>
            </div>
        </div>
    </div>
</template>

<script setup>
import HomeIcon from "../Icons/HomeIcon.vue";
import DiscountIcon from "../Icons/DiscountIcon.vue";
import GraphIcon from "../Icons/GraphIcon.vue";
import MessageIcon from "../Icons/MessageIcon.vue";
import NotificationIcon from "../Icons/NotificationIcon.vue";
import SettingsIcon from "../Icons/SettingIcon.vue";
import LogoutIcon from "../Icons/LogoutIcon.vue";
import StoreIcon from "../Icons/StoreIcon.vue";
import UsersIcon from "../Icons/UsersIcon.vue";

import { ref } from "vue";

import { Link } from "@inertiajs/inertia-vue3";
import NavLink from "./NavLink.vue";

const activeMenu = ref("Notificatons");

const menus = [
    {
        name: "Dashboard",
        icon: HomeIcon,
        link: "products.index",
        method: "get",
        permission: "1",
    },
    {
        name: "Discounts",
        icon: DiscountIcon,
        link: "transactions.index",
        method: "get",
        permission: "1",
    },
    {
        name: "Graph",
        icon: GraphIcon,
        link: "admin/reports",
        method: "get",
        permission: "1",
    },
    {
        name: "Messages",
        icon: MessageIcon,
        link: "categories.index",
        method: "get",
        permission: "1",
    },
    {
        name: "Notifications",
        icon: NotificationIcon,
        link: "customers.index",
        method: "get",
        permission: "2",
    },
    {
        name: "Settings",
        icon: SettingsIcon,
        link: "admin/settings",
        method: "get",
        permission: "1",
    },
    {
        name: "Users",
        icon: UsersIcon,
        link: "profile.show",
        method: "get",
        permission: "2",
    },
    {
        name: "Logout",
        icon: LogoutIcon,
        link: "logout",
        method: "post",
        permission: "2",
    },
];
</script>
