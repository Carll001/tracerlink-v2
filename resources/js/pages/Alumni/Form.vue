<script setup lang="ts">
import { computed } from 'vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import alumniLink from '@/routes/alumni'

import AppLayout from '@/layouts/AppLayout.vue'

import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Button } from '@/components/ui/button'
import { Alert, AlertDescription, AlertTitle } from '@/components/ui/alert'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'

const page = usePage()

const form = useForm({
  student_number: '',
  first_name: '',
  middle_initial: '',
  last_name: '',
  contact_number: '',
  email: '',
  address: '',

  program_taken: '',
  year_batch_graduated: '',

  employment_status: 'Employed',
  employment_sector: '',
  company_name: '',
  work_location: '',

  overall_rating: 5,
})

const isWorkFieldsDisabled = computed(() => {
  return form.employment_status === 'Unemployed' || form.employment_status === 'Student'
})

function submit() {
  form.post(alumniLink.store().url, {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })
}
</script>

<template>
  <AppLayout>
    <Head title="Alumni Information Form" />

    <div class="mx-auto w-full max-w-4xl p-4 md:p-8">
      <Card class="rounded-2xl">
        <CardHeader>
          <CardTitle class="text-2xl">ALUMNI INFORMATION FORM</CardTitle>
          <CardDescription>Please complete the details below.</CardDescription>
        </CardHeader>

        <CardContent class="space-y-8">
          <Alert v-if="(page.props as any).flash?.success" class="rounded-xl">
            <AlertTitle>Success</AlertTitle>
            <AlertDescription>{{ (page.props as any).flash.success }}</AlertDescription>
          </Alert>

          <form class="space-y-8" @submit.prevent="submit">
            <!-- PERSONAL -->
            <section class="space-y-4">
              <h2 class="text-lg font-semibold">Personal Information</h2>

              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-2">
                  <Label>Student Number</Label>
                  <Input v-model="form.student_number" placeholder="e.g. 2020-12345" />
                  <p v-if="form.errors.student_number" class="text-sm text-destructive">{{ form.errors.student_number }}</p>
                </div>

                <div class="space-y-2">
                  <Label>Contact Number</Label>
                  <Input v-model="form.contact_number" placeholder="09xxxxxxxxx" />
                  <p v-if="form.errors.contact_number" class="text-sm text-destructive">{{ form.errors.contact_number }}</p>
                </div>

                <div class="space-y-2">
                  <Label>First Name</Label>
                  <Input v-model="form.first_name" />
                  <p v-if="form.errors.first_name" class="text-sm text-destructive">{{ form.errors.first_name }}</p>
                </div>

                <div class="space-y-2">
                  <Label>Middle Initial</Label>
                  <Input v-model="form.middle_initial" placeholder="e.g. A" />
                  <p v-if="form.errors.middle_initial" class="text-sm text-destructive">{{ form.errors.middle_initial }}</p>
                </div>

                <div class="space-y-2">
                  <Label>Last Name</Label>
                  <Input v-model="form.last_name" />
                  <p v-if="form.errors.last_name" class="text-sm text-destructive">{{ form.errors.last_name }}</p>
                </div>

                <div class="space-y-2">
                  <Label>Active Email Address</Label>
                  <Input v-model="form.email" type="email" placeholder="name@email.com" />
                  <p v-if="form.errors.email" class="text-sm text-destructive">{{ form.errors.email }}</p>
                </div>
              </div>

              <div class="space-y-2">
                <Label>Address</Label>
                <Textarea v-model="form.address" rows="3" placeholder="Complete address..." />
                <p v-if="form.errors.address" class="text-sm text-destructive">{{ form.errors.address }}</p>
              </div>
            </section>

            <!-- ACADEMIC -->
            <section class="space-y-4">
              <h2 class="text-lg font-semibold">Academic Information</h2>

              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-2">
                  <Label>Program Taken</Label>
                  <Input v-model="form.program_taken" placeholder="e.g. BSIT" />
                  <p v-if="form.errors.program_taken" class="text-sm text-destructive">{{ form.errors.program_taken }}</p>
                </div>

                <div class="space-y-2">
                  <Label>Year / Batch Graduated</Label>
                  <Input v-model="form.year_batch_graduated" placeholder="e.g. 2025" />
                  <p v-if="form.errors.year_batch_graduated" class="text-sm text-destructive">{{ form.errors.year_batch_graduated }}</p>
                </div>
              </div>
            </section>

            <!-- EMPLOYMENT -->
            <section class="space-y-4">
              <h2 class="text-lg font-semibold">Employment Information</h2>

              <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="space-y-2">
                  <Label>Employment Status</Label>
                  <Select v-model="form.employment_status">
                    <SelectTrigger><SelectValue placeholder="Select status" /></SelectTrigger>
                    <SelectContent>
                      <SelectItem value="Employed">Employed</SelectItem>
                      <SelectItem value="Unemployed">Unemployed</SelectItem>
                      <SelectItem value="Self-Employed">Self-Employed</SelectItem>
                      <SelectItem value="Student">Student</SelectItem>
                      <SelectItem value="Other">Other</SelectItem>
                    </SelectContent>
                  </Select>
                  <p v-if="form.errors.employment_status" class="text-sm text-destructive">{{ form.errors.employment_status }}</p>
                </div>

                <div class="space-y-2">
                  <Label>Sector of Employment</Label>
                  <Input v-model="form.employment_sector" :disabled="isWorkFieldsDisabled" placeholder="e.g. IT, Education" />
                  <p v-if="form.errors.employment_sector" class="text-sm text-destructive">{{ form.errors.employment_sector }}</p>
                </div>

                <div class="space-y-2">
                  <Label>Company / Workplace Name</Label>
                  <Input v-model="form.company_name" :disabled="isWorkFieldsDisabled" placeholder="Company name" />
                  <p v-if="form.errors.company_name" class="text-sm text-destructive">{{ form.errors.company_name }}</p>
                </div>

                <div class="space-y-2">
                  <Label>Work Location</Label>
                  <Input v-model="form.work_location" :disabled="isWorkFieldsDisabled" placeholder="City / Country" />
                  <p v-if="form.errors.work_location" class="text-sm text-destructive">{{ form.errors.work_location }}</p>
                </div>
              </div>
            </section>

            <!-- FEEDBACK -->
            <section class="space-y-4">
              <h2 class="text-lg font-semibold">Feedback</h2>

              <div class="space-y-2 max-w-xs">
                <Label>Overall Rating (1–5)</Label>
                <Select v-model="form.overall_rating">
                  <SelectTrigger><SelectValue placeholder="Choose rating" /></SelectTrigger>
                  <SelectContent>
                    <SelectItem :value="1">1</SelectItem>
                    <SelectItem :value="2">2</SelectItem>
                    <SelectItem :value="3">3</SelectItem>
                    <SelectItem :value="4">4</SelectItem>
                    <SelectItem :value="5">5</SelectItem>
                  </SelectContent>
                </Select>
                <p v-if="form.errors.overall_rating" class="text-sm text-destructive">{{ form.errors.overall_rating }}</p>
              </div>
            </section>

            <div class="flex items-center gap-3">
              <Button type="submit" :disabled="form.processing">
                {{ form.processing ? 'Submitting...' : 'Submit Form' }}
              </Button>
              <p v-if="form.recentlySuccessful" class="text-sm text-muted-foreground">Saved.</p>
            </div>
          </form>
        </CardContent>
      </Card>
    </div>
  </AppLayout>
</template>
