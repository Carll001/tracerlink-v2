<script setup lang="ts">
import Create from '@/components/Program/Create.vue';
import Table from '@/components/Program/Table.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Program, type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Program Management',
        href: '',
    },
];

defineProps<{
    programs: Program[];
}>();
</script>
<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Program Management" />

        <div class="flex flex-1 flex-col gap-4 p-4">
            <section>
                <div class="flex justify-end">
                    <Create />
                </div>

                <div>
                    <Table :programs="programs"/>
                </div>
            </section>
        </div>
    </AppLayout>
</template>
