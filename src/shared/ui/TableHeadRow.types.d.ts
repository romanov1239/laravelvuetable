export type ColumnType = '' | 'actions' | string

export interface IColumn {
    type?: ColumnType,
    title?: string,
    minWidth?: boolean,
    itemKey?: string,
}

export type TColumns = Array<IColumn>
