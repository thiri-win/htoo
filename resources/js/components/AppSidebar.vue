<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Download, LayoutGrid, ListCheckIcon, NotebookPen, Plus, PrinterIcon } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'ဘောက်ချာအသစ်ဖွင့်ရန်',
        href: '/vouchers/create',
        icon: Plus,
    },
    {
        title: 'ဘောက်ချာprintထုတ်ရန်',
        href: '/vouchers',
        icon: PrinterIcon,
    },
    {
        title: 'စာရင်းအသစ်ထည့်ရန်',
        href: '/records/create',
        icon: NotebookPen,
    },

];

const settingNavItems: NavItem[] = [
    {
        title: 'အကြောင်းအရာများ',
        href: '/categories',
        icon: ListCheckIcon,
    },
    // {
    //     title: 'Database Backup',
    //     href: route('backup-database'),
    //     icon: Download,
    // },

];

const footerNavItems: NavItem[] = [
    // {
    //     title: 'Github Repo',
    //     href: 'https://github.com/laravel/vue-starter-kit',
    //     icon: Folder,
    // },
    // {
    //     title: 'Documentation',
    //     href: 'https://laravel.com/docs/starter-kits#vue',
    //     icon: BookOpen,
    // },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain title="MAIN" :items="mainNavItems" />
            <NavMain title="SETTING" :items="settingNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
