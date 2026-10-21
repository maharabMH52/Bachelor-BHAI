'use client'

import { useState } from 'react'
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group"
import { Textarea } from "@/components/ui/textarea"
import { toast } from "@/components/ui/use-toast"

export default function EnhancedComplaintForm() {
  const [step, setStep] = useState(1)
  const [category, setCategory] = useState('')
  const [name, setName] = useState('')
  const [email, setEmail] = useState('')
  const [phone, setPhone] = useState('')
  const [description, setDescription] = useState('')
  const [preferredResolution, setPreferredResolution] = useState('')

  const handleCategorySubmit = (e: React.FormEvent) => {
    e.preventDefault()
    if (category) {
      setStep(2)
    } else {
      toast({
        title: "Error",
        description: "Please select a complaint category.",
        variant: "destructive",
      })
    }
  }

  const handleComplainantSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    if (name && email) {
      setStep(3)
    } else {
      toast({
        title: "Error",
        description: "Please provide your name and email.",
        variant: "destructive",
      })
    }
  }

  const handleFinalSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    if (description) {
      // Here you would typically send the data to your backend
      console.log({ category, name, email, phone, description, preferredResolution })
      toast({
        title: "Complaint Submitted",
        description: "We've received your complaint and will get back to you within 24-48 hours.",
      })
      // Reset form
      setStep(1)
      setCategory('')
      setName('')
      setEmail('')
      setPhone('')
      setDescription('')
      setPreferredResolution('')
    } else {
      toast({
        title: "Error",
        description: "Please provide a detailed description of your complaint.",
        variant: "destructive",
      })
    }
  }

  return (
    <div className="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg">
      <h1 className="text-2xl font-bold mb-6 text-center">Bachelor Bhai Complaint Form</h1>
      {step === 1 && (
        <form onSubmit={handleCategorySubmit} className="space-y-6">
          <div>
            <Label htmlFor="category">Complaint Category</Label>
            <RadioGroup value={category} onValueChange={setCategory} className="mt-2">
              <div className="flex items-center space-x-2">
                <RadioGroupItem value="house-owner" id="house-owner" />
                <Label htmlFor="house-owner">House Owner Issues</Label>
              </div>
              <div className="flex items-center space-x-2">
                <RadioGroupItem value="appliance-seller" id="appliance-seller" />
                <Label htmlFor="appliance-seller">Appliance Seller Problems</Label>
              </div>
              <div className="flex items-center space-x-2">
                <RadioGroupItem value="meal-service" id="meal-service" />
                <Label htmlFor="meal-service">Meal Service Concerns</Label>
              </div>
              <div className="flex items-center space-x-2">
                <RadioGroupItem value="home-shifting" id="home-shifting" />
                <Label htmlFor="home-shifting">Home Shifting Issues</Label>
              </div>
              <div className="flex items-center space-x-2">
                <RadioGroupItem value="roommate-seeker" id="roommate-seeker" />
                <Label htmlFor="roommate-seeker">Roommate Seeker Complaints</Label>
              </div>
            </RadioGroup>
          </div>
          <Button type="submit" className="w-full">Next</Button>
        </form>
      )}
      {step === 2 && (
        <form onSubmit={handleComplainantSubmit} className="space-y-6">
          <div>
            <Label htmlFor="name">Full Name</Label>
            <Input
              type="text"
              id="name"
              value={name}
              onChange={(e) => setName(e.target.value)}
              placeholder="Enter your full name"
              className="mt-1"
              required
            />
          </div>
          <div>
            <Label htmlFor="email">Email</Label>
            <Input
              type="email"
              id="email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              placeholder="Enter your email address"
              className="mt-1"
              required
            />
          </div>
          <div>
            <Label htmlFor="phone">Phone Number (Optional)</Label>
            <Input
              type="tel"
              id="phone"
              value={phone}
              onChange={(e) => setPhone(e.target.value)}
              placeholder="Enter your phone number"
              className="mt-1"
            />
          </div>
          <Button type="submit" className="w-full">Next</Button>
        </form>
      )}
      {step === 3 && (
        <form onSubmit={handleFinalSubmit} className="space-y-6">
          <div>
            <Label htmlFor="description">Detailed Description</Label>
            <Textarea
              id="description"
              value={description}
              onChange={(e) => setDescription(e.target.value)}
              placeholder="Provide as much detail as possible about your complaint..."
              className="mt-1"
              required
            />
          </div>
          <div>
            <Label htmlFor="preferredResolution">Preferred Resolution (Optional)</Label>
            <Textarea
              id="preferredResolution"
              value={preferredResolution}
              onChange={(e) => setPreferredResolution(e.target.value)}
              placeholder="Let us know how you would like the issue to be resolved..."
              className="mt-1"
            />
          </div>
          <Button type="submit" className="w-full">Submit Complaint</Button>
        </form>
      )}
    </div>
  )
}