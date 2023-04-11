<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="/">
    <html>
      <head>
        <link rel="stylesheet" type="text/css" href="style.css"/>
      </head>
      <body>
        <xsl:apply-templates/>
      </body>
    </html>
  </xsl:template>

  <xsl:template match="employees">
    <table>
      <xsl:apply-templates/>
    </table>
  </xsl:template>

  <xsl:template match="employee">
    <tr>
      <td>
        <xsl:value-of select="name"/>
      </td>
      <td>
        <xsl:apply-templates select="phones"/>
      </td>
      <td>
        <xsl:apply-templates select="addresses"/>
      </td>
      <td>
        <xsl:value-of select="email"/>
      </td>
    </tr>
  </xsl:template>

  <xsl:template match="phones">
    <xsl:for-each select="phone">
      <div>
        <xsl:value-of select="."/>
      </div>
    </xsl:for-each>
  </xsl:template>

  <xsl:template match="addresses">
    <xsl:for-each select="address">
      <div>
        <xsl:value-of select="street"/>
        <xsl:value-of select="city"/>
        <xsl:value-of select="country"/>
        <xsl:value-of select="building"/>
        <xsl:value-of select="region"/>
      </div>
    </xsl:for-each>
  </xsl:template>

</xsl:stylesheet>
