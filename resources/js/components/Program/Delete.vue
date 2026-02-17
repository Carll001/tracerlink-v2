<script setup lang="ts">
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import Button from '../ui/button/Button.vue';
import { Trash2 } from 'lucide-vue-next';
import { useForm } from '@inertiajs/vue3';
import program from '@/routes/program';
import { toast } from 'vue-sonner';
import { ref } from 'vue';
import type { Program } from '@/types';

interface Props {
    program: Program;
}

const props = defineProps<Props>();
const closeModal = ref(false);

const form = useForm({});

const deleteProgram = () => {
    form.delete(program.destroy(props.program.id).url, {
        onSuccess: () => {
            toast.success('Program deleted successfully!');
            closeModal.value = false;
        },
    });
};
</script>

<template>
    <Dialog v-model:open="closeModal">
        <DialogTrigger asChild>
            <Button variant="ghost" size="sm">
                <Trash2 class="h-4 w-4 text-red-600" />
            </Button>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Delete Program</DialogTitle>
                <DialogDescription>
                    Are you sure you want to delete this program? This action
                    cannot be undone.
                </DialogDescription>
            </DialogHeader>
            <p class="text-sm text-muted-foreground">
                <strong>{{ props.program.name }}</strong> will be permanently deleted.
            </p>
            <DialogFooter>
                <DialogClose>
                    <Button variant="ghost">Cancel</Button>
                </DialogClose>
                <Button
                    variant="destructive"
                    @click="deleteProgram"
                >Delete
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
