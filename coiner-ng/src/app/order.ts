export class Order {
   constructor(
      public name: string,
      public email: string,
      public phone: number | null,
      public question: string,
      public sendText: boolean | null,
   ){}
}
