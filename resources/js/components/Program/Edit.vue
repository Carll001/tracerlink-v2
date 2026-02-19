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
import Input from '../ui/input/Input.vue';
import Label from '../ui/label/Label.vue';
import { AlertCircle, Pencil } from 'lucide-vue-next';
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

const form = useForm({
    name: props.program.name,
});

const handleSubmit = () => {
    form.put(program.update(props.program.id).url, {
        onSuccess: () => {
            toast.success('Program updated successfully!');
            closeModal.value = false;
            form.reset();
        },
        onError: () => {
            toast.error('Something went wrong!');
        },
    });
};

const handleCloseModal = () => {
    closeModal.value = false;
    form.reset();
    form.clearErrors();
};
</script>

<template>
    <Dialog v-model:open="closeModal">
        <DialogTrigger asChild>
            <Button variant="ghost" size="sm">
                <Pencil class="h-4 w-4" />
            </Button>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Edit Program</DialogTitle>
                <DialogDescription>
                    Update the program details below.
                </DialogDescription>
            </DialogHeader>
            <form @submit.prevent="handleSubmit" class="space-y-4">
                <section>
                    <div class="space-y-2">
                        <Label>Program Name</Label>
                        <Input
                            v-model="form.name"
                            placeholder="Program Name"
                        />
                    </div>
                    <div v-if="form.errors.name">
                        <p
                            class="flex items-center gap-1 text-sm text-red-600"
                        >
                            <AlertCircle class="h-4 w-4" />
                            {{ form.errors.name }}
                        </p>
                    </div>
                </section>
                <DialogFooter>
                    <DialogClose as-child>
                        <Button @click="handleCloseModal" variant="ghost">Cancel</Button>
                    </DialogClose>
                    <Button type="submit" :disabled="form.processing">
                       Update
                    </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>
</template>
