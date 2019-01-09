import {Observable} from "rxjs/internal/Observable";
import construct = Reflect.construct;

export interface SearchParams{
    page?: number;
    all?: any;
    search?: string;
    sort?: {
        column: string;
        sort: string;
    }
}

export class SearchParamsBuilder{

    constructor(private searchParams: SearchParams){

    }

    makeObject(): SearchParams {
        const sParams: any ={
            page: this.searchParams.page + "",
        };
        if(this.searchParams.all){
            sParams.all = '1';
            delete sParams.page;
        }
        if(this.searchParams.search && this.searchParams.search !== ''){
            sParams.search = this.searchParams.search;
        }
        if(this.searchParams.sort){
            const sortSymbol = this.searchParams.sort.sort === 'desc'? '-': '';
            const columnName = this.searchParams.sort.column;
            sParams.sort = `${sortSymbol}${columnName}`;
        }
        return sParams;
    }
}

export interface HttpResource<T> { //T tipo generico //Generics

    list(searchParams: SearchParams): Observable<{ data: Array<T>, meta: any}>;

    get(id: number): Observable<T>;

    update(id: number, data: T): Observable<T>;

    create(data: T): Observable<T>;

    destroy(id: number): Observable<any>;

}

// abstract class BaseHttp<T> implements HttpResource<T> {
//
//     abstract baseUrl();
//
//     create(data: T): Observable<T> {
//         return undefined;
//     }
//
//     destroy(id: number): Observable<any> {
//         return undefined;
//     }
//
//     get(id: number): Observable<T> {
//         return undefined;
//     }
//
//     list(page: number): Observable<{ data: Array<T>; meta: any }> {
//         const token = window.localStorage.getItem('token');
//         const params = new HttpParams({
//             fromObject:{
//                 page: page + "" // concatena com vazio para transformar em string para não dar erro de compilação
//             }
//         });
//         return this.http
//             .get<{ data: Array<Product>, meta: any}>
//             (this.baseUrl(), {
//                 params,
//                 headers: {
//                     'Authorization': `Bearer ${token}`
//                 }
//             });
//     }
//
//     update(id: number, data: T): Observable<T> {
//         return undefined;
//     }
// }
