import { Purchase } from "./purchase"

export interface Attendee {
  id: number
  nombre: string
  purchases: Purchase[]
}