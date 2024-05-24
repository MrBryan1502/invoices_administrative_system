import { PURCHASE_STATUS } from "../constants/purchase"

export type PurchaseStatus = typeof PURCHASE_STATUS[keyof typeof PURCHASE_STATUS]

export interface Purchase {
  id: number
  edicion: number
  status: PurchaseStatusStatus
}