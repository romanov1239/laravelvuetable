import { TColumns } from "@/shared/ui/TableHeadRow.types";
import { TBodyColumns } from "@/shared/ui/TableBodyRow.types";

export type TableColumns = TColumns|TBodyColumns


export type TAvailableSorting = undefined | 'asc' | 'desc';
