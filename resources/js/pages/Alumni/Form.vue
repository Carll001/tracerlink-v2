<script setup lang="ts">
import { computed, watch } from 'vue'
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
  sex: '',
  email: '',
  address: '',

  program_taken: '',
  year_batch_graduated: '',
  further_studies: '',

  employment_status: 'No Answer',
  employment_sector: '',
  employment_classification: '',
  company_name: '',
  work_location: '',

  position_nature_of_work: '',
  job_aligned_with_course: '',

  overall_rating: 5,
})

const isWorkFieldsDisabled = computed(() => {
  return form.employment_status !== 'Employed'
})

const showEmploymentDetails = computed(() => {
  return form.employment_status === 'Employed'
})

watch(
  () => form.employment_status,
  (val) => {
    if (val !== 'Employed') {
      form.employment_sector = ''
      form.employment_classification = ''
      form.company_name = ''
      form.work_location = ''
      form.position_nature_of_work = ''
      form.job_aligned_with_course = ''
    }
  }
)

const graduationYears = computed(() => {
  const startYear = 2022
  const currentYear = new Date().getFullYear()

  const years: number[] = []
  for (let y = startYear; y <= currentYear; y++) years.push(y)

  return years.reverse()
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

    <div class="mx-auto w-full max-w-4xl p-4 md:p-10">
      <Card class="rounded-2xl border-muted/60 shadow-sm">
        <CardHeader class="space-y-2">
          <div class="space-y-1">
            <CardTitle class="text-2xl tracking-tight md:text-3xl">ALUMNI INFORMATION FORM</CardTitle>
            <CardDescription class="text-base">Please complete the details below.</CardDescription>
          </div>
          <div class="h-px w-full bg-border/70" />
        </CardHeader>

        <CardContent class="space-y-10">
          <Alert v-if="(page.props as any).flash?.success" class="rounded-xl border-border/60">
            <AlertTitle>Success</AlertTitle>
            <AlertDescription>{{ (page.props as any).flash.success }}</AlertDescription>
          </Alert>

          <form class="space-y-10" @submit.prevent="submit">
            <!-- PERSONAL -->
            <section class="space-y-5">
              <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold md:text-xl">Personal Information</h2>
              </div>

              <div class="rounded-2xl border border-border/60 p-4 md:p-6">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Student Number</Label>
                    <Input v-model="form.student_number" placeholder="e.g. 2020-12345" class="h-10" />
                    <p v-if="form.errors.student_number" class="text-sm text-destructive">{{ form.errors.student_number }}</p>
                  </div>

                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Contact Number</Label>
                    <Input v-model="form.contact_number" placeholder="09xxxxxxxxx" class="h-10" />
                    <p v-if="form.errors.contact_number" class="text-sm text-destructive">{{ form.errors.contact_number }}</p>
                  </div>

                  <div class="space-y-2">
                    <Label class="text-sm font-medium">First Name</Label>
                    <Input v-model="form.first_name" class="h-10" />
                    <p v-if="form.errors.first_name" class="text-sm text-destructive">{{ form.errors.first_name }}</p>
                  </div>

                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Middle Initial</Label>
                    <Input v-model="form.middle_initial" placeholder="e.g. A" class="h-10" />
                    <p v-if="form.errors.middle_initial" class="text-sm text-destructive">{{ form.errors.middle_initial }}</p>
                  </div>

                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Last Name</Label>
                    <Input v-model="form.last_name" class="h-10" />
                    <p v-if="form.errors.last_name" class="text-sm text-destructive">{{ form.errors.last_name }}</p>
                  </div>

                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Sex</Label>
                    <Select v-model="form.sex">
                      <SelectTrigger class="h-10"><SelectValue placeholder="Select sex" /></SelectTrigger>
                      <SelectContent>
                        <SelectItem value="Male">Male</SelectItem>
                        <SelectItem value="Female">Female</SelectItem>
                        <SelectItem value="Prefer not to say">Prefer not to say</SelectItem>
                      </SelectContent>
                    </Select>
                    <p v-if="form.errors.sex" class="text-sm text-destructive">{{ form.errors.sex }}</p>
                  </div>

                  <div class="space-y-2 md:col-span-2">
                    <Label class="text-sm font-medium">Active Email Address</Label>
                    <Input v-model="form.email" type="email" placeholder="name@email.com" class="h-10" />
                    <p v-if="form.errors.email" class="text-sm text-destructive">{{ form.errors.email }}</p>
                  </div>
                </div>

                <div class="mt-5 space-y-2">
                  <Label class="text-sm font-medium">Address</Label>
                  <Textarea v-model="form.address" rows="3" placeholder="Complete address..." class="min-h-[96px]" />
                  <p v-if="form.errors.address" class="text-sm text-destructive">{{ form.errors.address }}</p>
                </div>
              </div>
            </section>

            <!-- ACADEMIC -->
            <section class="space-y-5">
              <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold md:text-xl">Academic Information</h2>
              </div>

              <div class="rounded-2xl border border-border/60 p-4 md:p-6">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Program Taken</Label>
                    <Input v-model="form.program_taken" placeholder="e.g. BSIT" class="h-10" />
                    <p v-if="form.errors.program_taken" class="text-sm text-destructive">{{ form.errors.program_taken }}</p>
                  </div>

                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Year / Batch Graduated</Label>
                    <Select v-model="form.year_batch_graduated">
                      <SelectTrigger class="h-10">
                        <SelectValue placeholder="Select year" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem v-for="y in graduationYears" :key="y" :value="String(y)">
                          {{ y }}
                        </SelectItem>
                      </SelectContent>
                    </Select>
                    <p v-if="form.errors.year_batch_graduated" class="text-sm text-destructive">
                      {{ form.errors.year_batch_graduated }}
                    </p>
                  </div>

                  <div class="space-y-2 md:col-span-2">
                    <Label class="text-sm font-medium">Further Studies</Label>
                    <Select v-model="form.further_studies">
                      <SelectTrigger class="h-10"><SelectValue placeholder="Select option" /></SelectTrigger>
                      <SelectContent>
                        <SelectItem value="Yes">Yes</SelectItem>
                        <SelectItem value="No">No</SelectItem>
                        <SelectItem value="No Answer">No Answer</SelectItem>
                      </SelectContent>
                    </Select>
                    <p v-if="form.errors.further_studies" class="text-sm text-destructive">{{ form.errors.further_studies }}</p>
                  </div>
                </div>
              </div>
            </section>

            <!-- EMPLOYMENT -->
            <section class="space-y-5">
              <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold md:text-xl">Employment Information</h2>
              </div>

              <div class="rounded-2xl border border-border/60 p-4 md:p-6">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Employment Status</Label>
                    <Select v-model="form.employment_status">
                      <SelectTrigger class="h-10"><SelectValue placeholder="Select status" /></SelectTrigger>
                      <SelectContent>
                        <SelectItem value="Employed">Employed</SelectItem>
                        <SelectItem value="Unemployed">Unemployed</SelectItem>
                        <SelectItem value="No Answer">No Answer</SelectItem>
                      </SelectContent>
                    </Select>
                    <p v-if="form.errors.employment_status" class="text-sm text-destructive">{{ form.errors.employment_status }}</p>
                  </div>
                </div>

                <div v-if="showEmploymentDetails" class="mt-5 grid grid-cols-1 gap-5 md:grid-cols-2">
                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Sector of Employment</Label>
                    <Select v-model="form.employment_sector" :disabled="isWorkFieldsDisabled">
                      <SelectTrigger class="h-10"><SelectValue placeholder="Select sector" /></SelectTrigger>
                      <SelectContent>
                        <SelectItem value="Government">Government</SelectItem>
                        <SelectItem value="Private">Private</SelectItem>
                        <SelectItem value="Self Employment">Self Employment</SelectItem>
                      </SelectContent>
                    </Select>
                    <p v-if="form.errors.employment_sector" class="text-sm text-destructive">{{ form.errors.employment_sector }}</p>
                  </div>

                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Employment Classification</Label>
                    <Select v-model="form.employment_classification" :disabled="isWorkFieldsDisabled">
                      <SelectTrigger class="h-10"><SelectValue placeholder="Select classification" /></SelectTrigger>
                      <SelectContent>
                        <SelectItem value="Local Company PH">Local Company PH</SelectItem>
                        <SelectItem value="Foreign Company in PH">Foreign Company in PH</SelectItem>
                        <SelectItem value="Foreign Company in Abroad">Foreign Company in Abroad</SelectItem>
                        <SelectItem value="I am Self Employed">I am Self Employed</SelectItem>
                      </SelectContent>
                    </Select>
                    <p v-if="form.errors.employment_classification" class="text-sm text-destructive">
                      {{ form.errors.employment_classification }}
                    </p>
                  </div>

                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Company / Workplace Name</Label>
                    <Input v-model="form.company_name" :disabled="isWorkFieldsDisabled" placeholder="Company name" class="h-10" />
                    <p v-if="form.errors.company_name" class="text-sm text-destructive">{{ form.errors.company_name }}</p>
                  </div>

                  <div class="space-y-2">
                    <Label class="text-sm font-medium">Work Location</Label>
                    <Input v-model="form.work_location" :disabled="isWorkFieldsDisabled" placeholder="City / Country" class="h-10" />
                    <p v-if="form.errors.work_location" class="text-sm text-destructive">{{ form.errors.work_location }}</p>
                  </div>

                  <div class="space-y-2 md:col-span-2">
                    <Label class="text-sm font-medium">Position / Nature of Work</Label>
                    <Input
                      v-model="form.position_nature_of_work"
                      :disabled="isWorkFieldsDisabled"
                      placeholder="e.g. Software Developer / IT Support"
                      class="h-10"
                    />
                    <p v-if="form.errors.position_nature_of_work" class="text-sm text-destructive">
                      {{ form.errors.position_nature_of_work }}
                    </p>
                  </div>

                  <div class="space-y-2 md:col-span-2">
                    <Label class="text-sm font-medium">Is your job aligned with the course you have taken?</Label>
                    <Select v-model="form.job_aligned_with_course" :disabled="isWorkFieldsDisabled">
                      <SelectTrigger class="h-10"><SelectValue placeholder="Select option" /></SelectTrigger>
                      <SelectContent>
                        <SelectItem value="Yes">Yes</SelectItem>
                        <SelectItem value="No">No</SelectItem>
                        <SelectItem value="No Answer">No Answer</SelectItem>
                      </SelectContent>
                    </Select>
                    <p v-if="form.errors.job_aligned_with_course" class="text-sm text-destructive">
                      {{ form.errors.job_aligned_with_course }}
                    </p>
                  </div>
                </div>
              </div>
            </section>

            <!-- FEEDBACK -->
            <section class="space-y-5">
              <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold md:text-xl">Feedback</h2>
              </div>

              <div class="rounded-2xl border border-border/60 p-4 md:p-6">
                <div class="space-y-2 max-w-xs">
                  <Label class="text-sm font-medium">Overall Rating (1–5)</Label>
                  <Select v-model="form.overall_rating">
                    <SelectTrigger class="h-10"><SelectValue placeholder="Choose rating" /></SelectTrigger>
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
              </div>
            </section>

            <div class="sticky bottom-4 z-10">
              <div class="rounded-2xl border border-border/60 bg-background/90 p-3 backdrop-blur supports-[backdrop-filter]:bg-background/70">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                  <div class="text-sm text-muted-foreground">
                    Please review your entries before submitting.
                  </div>
                  <div class="flex items-center gap-3">
                    <Button type="submit" :disabled="form.processing" class="h-10 px-6">
                      {{ form.processing ? 'Submitting...' : 'Submit Form' }}
                    </Button>
                    <p v-if="form.recentlySuccessful" class="text-sm text-muted-foreground">Saved.</p>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </CardContent>
      </Card>
    </div>
  </AppLayout>
</template>
