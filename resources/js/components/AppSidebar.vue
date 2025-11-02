<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Calculator, DollarSign, LayoutGrid, List, ListCheckIcon, MessageCircle, NotebookPen, Plus } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'စာရင်းများကြည့်ရန်',
        href: '/records',
        icon: List,
    },
];

const incomeNavItems: NavItem[] = [
    {
        title: 'ဘောက်ချာအသစ်ဖွင့်ရန်',
        href: '/records/vouchers/create',
        icon: Plus,
    },
];

const expenseNavItems: NavItem[] = [
    {
        title: 'ပစ္စည်းဝယ်စာရင်း',
        href: '/records/expenses/create',
        icon: NotebookPen,
    },
    {
        title: 'အသုံးစာရင်း',
        href: '/records/create',
        icon: DollarSign,
    },
    {
        title: 'လုပ်အားခတွက်ချက်ရန်',
        href: '/records/salary/create',
        icon: Calculator,
    },
];

const settingNavItems: NavItem[] = [
    {
        title: 'အကြောင်းအရာများ',
        href: '/categories',
        icon: ListCheckIcon,
    },
    {
        title: 'Message',
        href: '/chatify',
        icon: MessageCircle,
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
            <NavMain title="INCOME" :items="incomeNavItems" />
            <NavMain title="EXPENSE" :items="expenseNavItems" />
            <NavMain title="SETTING" :items="settingNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
