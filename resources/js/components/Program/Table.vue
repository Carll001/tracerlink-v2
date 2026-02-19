<script setup lang="ts">
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import {
    Empty,
    EmptyDescription,
    EmptyHeader,
    EmptyMedia,
    EmptyTitle,
} from '@/components/ui/empty';
import { TableOfContents } from 'lucide-vue-next';
import { Program } from '@/types';
import Edit from './Edit.vue';
import Delete from './Delete.vue';

defineProps<{
    programs: Program[];
}>();
</script>

<template>
    <div class="flex flex-1 flex-col gap-4 p-4">
        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead> # </TableHead>
                    <TableHead> Program Name </TableHead>
                    <TableHead class="flex justify-end"> Actions </TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow v-if="!programs.length">
                    <TableCell
                        colspan="3"
                        class=" py-6 text-muted-foreground"
                    >
                        <Empty>
                            <EmptyHeader>
                                <EmptyMedia variant="icon">
                                    <TableOfContents/>
                                </EmptyMedia>
                                <EmptyTitle>No Program Yet</EmptyTitle>
                                <EmptyDescription>
                                    You haven't created any program yet. Get
                                    started by creating programs.
                                </EmptyDescription>
                            </EmptyHeader>
                        </Empty>
                    </TableCell>
                </TableRow>

                <TableRow
                    v-else
                    v-for="(program, index) in programs"
                    :key="program.id"
                >
                    <TableCell>{{ index + 1 }}</TableCell>
                    <TableCell>{{ program.name }}</TableCell>
                    <TableCell>
                        <div class="flex justify-end space-x-2">
                            <Edit :program="program" />
                            <Delete :program="program" />
                        </div>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>
