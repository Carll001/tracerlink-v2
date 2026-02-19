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
import { AlertCircle } from 'lucide-vue-next';
import { useForm } from '@inertiajs/vue3';
import program from '@/routes/program';
import { toast } from 'vue-sonner';
import { ref } from 'vue';

const form = useForm({
    name: '',
});

const handleSubmit = () => {
    form.post(program.store().url, {
        onSuccess: () => {
            form.reset();
            toast.success('Program created successfully!')
            closeModal.value = false;
        },
        onError: () => {
            toast.error('Something went wrong!');
        },
    });
};

const closeModal = ref(false);

const handleCloseModal = () => {
    closeModal.value = false;
    form.reset();
    form.clearErrors();
};
</script>

<template>
    <div>
        <Dialog v-model:open="closeModal">
            <DialogTrigger asChild>
                <Button>Create a Program</Button>
            </DialogTrigger>
            <DialogContent>
                <DialogHeader>
                    <DialogTitle> Create a program </DialogTitle>
                    <DialogDescription>
                        Click save when you are done.
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
                            <Button @click="handleCloseModal" variant="ghost">Close</Button>
                        </DialogClose>
                        <Button type="submit">Save</Button>
                    </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    </div>
</template>
