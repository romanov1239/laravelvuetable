export type BodyColumnType = '' | 'actions' | 'link' | 'avatar'

export interface IBodyColumn {
    type?: BodyColumnType,
    title?: string,
    minWidth?: boolean,
    href?: string,
    src?: string,
    itemKey?: string,
}

export type TBodyColumns = Array<IBodyColumn>
