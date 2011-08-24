SELECT
`Captures`.`dateID`,
`Captures`.`URLs_idURLs`,
`Captures`.`date`,
`Captures`.`hash`,
`Captures`.`statusCode`,
`Captures`.`isModified`,
`Captures`.`size`,
`ContentTypes`.`type`,
`ContentTypes`.`subtype`
FROM `Captures`, `ContentTypes`
WHERE `Captures`.`dateID` = 'SALUT'
AND `Captures`.`URLs_idURLs` = 'PLOP'
AND `Captures`.`ContentTypes_idContentTypes` = `ContentTypes`.`idContentTypes`;