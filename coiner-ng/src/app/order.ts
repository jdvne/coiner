export class Order {
   constructor(
      public name: string,
      public email: string,
      public subject: string,
      public message: string,
      public anonymous: boolean
   ){}
}
